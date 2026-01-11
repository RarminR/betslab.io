<?php

namespace App\Http\Controllers\Admin;

use App\Events\TipPublished;
use App\Http\Controllers\Controller;
use App\Models\Tip;
use App\Models\TipSelection;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminTipController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    /**
     * Display a listing of tips.
     */
    public function index(Request $request)
    {
        $query = Tip::with('creator', 'selections');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by published status
        if ($request->has('published')) {
            $query->where('is_published', $request->published === 'yes');
        }

        $tips = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.tips.index', [
            'tips' => $tips,
        ]);
    }

    /**
     * Show the form for creating a new tip.
     */
    public function create()
    {
        return view('admin.tips.create');
    }

    /**
     * Store a newly created tip.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sport' => 'required|string|max:100',
            'stake' => 'required|integer|min:1|max:10',
            'channel_type' => 'required|in:free,vip',
            'analysis' => 'nullable|string|max:2000',
            'selections' => 'required|array|min:1',
            'selections.*.event_name' => 'required|string|max:255',
            'selections.*.event_date' => 'required|date',
            'selections.*.league' => 'nullable|string|max:255',
            'selections.*.prediction' => 'required|string|max:255',
            'selections.*.odds' => 'required|numeric|min:1',
        ]);

        $tip = DB::transaction(function () use ($validated) {
            $tip = Tip::create([
                'created_by' => Auth::id(),
                'title' => $validated['title'],
                'sport' => $validated['sport'],
                'stake' => $validated['stake'],
                'channel_type' => $validated['channel_type'],
                'analysis' => $validated['analysis'] ?? null,
                'total_odds' => 1.00, // Will be calculated
                'status' => 'pending',
                'result' => 'pending',
                'is_published' => false,
            ]);

            foreach ($validated['selections'] as $index => $selection) {
                TipSelection::create([
                    'tip_id' => $tip->id,
                    'event_name' => $selection['event_name'],
                    'event_date' => $selection['event_date'],
                    'league' => $selection['league'] ?? null,
                    'prediction' => $selection['prediction'],
                    'odds' => $selection['odds'],
                    'result' => 'pending',
                    'sort_order' => $index,
                ]);
            }

            // Calculate total odds
            $tip->calculateTotalOdds();

            return $tip;
        });

        return redirect()->route('admin.tips.show', $tip)
            ->with('success', 'Pronosticul a fost creat cu succes.');
    }

    /**
     * Display the specified tip.
     */
    public function show(Tip $tip)
    {
        $tip->load('creator', 'selections');

        return view('admin.tips.show', [
            'tip' => $tip,
        ]);
    }

    /**
     * Show the form for editing the specified tip.
     */
    public function edit(Tip $tip)
    {
        $tip->load('selections');

        return view('admin.tips.edit', [
            'tip' => $tip,
        ]);
    }

    /**
     * Update the specified tip.
     */
    public function update(Request $request, Tip $tip)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sport' => 'required|string|max:100',
            'stake' => 'required|integer|min:1|max:10',
            'channel_type' => 'required|in:free,vip',
            'analysis' => 'nullable|string|max:2000',
            'selections' => 'required|array|min:1',
            'selections.*.id' => 'nullable|exists:tip_selections,id',
            'selections.*.event_name' => 'required|string|max:255',
            'selections.*.event_date' => 'required|date',
            'selections.*.league' => 'nullable|string|max:255',
            'selections.*.prediction' => 'required|string|max:255',
            'selections.*.odds' => 'required|numeric|min:1',
            'selections.*.result' => 'required|in:pending,won,lost,void',
        ]);

        DB::transaction(function () use ($validated, $tip) {
            $tip->update([
                'title' => $validated['title'],
                'sport' => $validated['sport'],
                'stake' => $validated['stake'],
                'channel_type' => $validated['channel_type'],
                'analysis' => $validated['analysis'] ?? null,
            ]);

            // Get existing selection IDs
            $existingIds = collect($validated['selections'])
                ->pluck('id')
                ->filter()
                ->toArray();

            // Delete removed selections
            $tip->selections()->whereNotIn('id', $existingIds)->delete();

            // Update or create selections
            foreach ($validated['selections'] as $index => $selection) {
                if (!empty($selection['id'])) {
                    TipSelection::where('id', $selection['id'])->update([
                        'event_name' => $selection['event_name'],
                        'event_date' => $selection['event_date'],
                        'league' => $selection['league'] ?? null,
                        'prediction' => $selection['prediction'],
                        'odds' => $selection['odds'],
                        'result' => $selection['result'],
                        'sort_order' => $index,
                    ]);
                } else {
                    TipSelection::create([
                        'tip_id' => $tip->id,
                        'event_name' => $selection['event_name'],
                        'event_date' => $selection['event_date'],
                        'league' => $selection['league'] ?? null,
                        'prediction' => $selection['prediction'],
                        'odds' => $selection['odds'],
                        'result' => $selection['result'],
                        'sort_order' => $index,
                    ]);
                }
            }

            // Recalculate total odds
            $tip->refresh();
            $tip->calculateTotalOdds();
            $tip->updateResultFromSelections();
        });

        return redirect()->route('admin.tips.show', $tip)
            ->with('success', 'Pronosticul a fost actualizat cu succes.');
    }

    /**
     * Remove the specified tip.
     */
    public function destroy(Tip $tip)
    {
        $tip->delete();

        return redirect()->route('admin.tips.index')
            ->with('success', 'Pronosticul a fost șters cu succes.');
    }

    /**
     * Publish a tip.
     */
    public function publish(Tip $tip)
    {
        $tip->publish();

        // Dispatch event to send to Telegram
        event(new TipPublished($tip));

        return redirect()->route('admin.tips.show', $tip)
            ->with('success', 'Pronosticul a fost publicat și trimis pe Telegram.');
    }

    /**
     * Unpublish a tip.
     */
    public function unpublish(Tip $tip)
    {
        $tip->unpublish();

        return redirect()->route('admin.tips.show', $tip)
            ->with('success', 'Pronosticul a fost depublicat.');
    }

    /**
     * Update selection result.
     */
    public function updateSelectionResult(Request $request, TipSelection $selection)
    {
        $validated = $request->validate([
            'result' => 'required|in:pending,won,lost,void',
        ]);

        $selection->update(['result' => $validated['result']]);
        $selection->tip->updateResultFromSelections();

        return redirect()->back()
            ->with('success', 'Rezultatul a fost actualizat.');
    }

    /**
     * Send tip result to Telegram.
     */
    public function sendResult(Tip $tip)
    {
        if ($tip->result === 'pending') {
            return redirect()->back()
                ->with('error', 'Nu poți trimite rezultatul unui pronostic în așteptare.');
        }

        // Send to the appropriate channel based on tip's channel_type
        $channelType = $tip->channel_type ?? 'vip';
        $results = $this->telegramService->sendTipResultToChannels($tip, $tip->isFree());

        $success = ($results[$channelType]['success'] ?? false);

        if ($success) {
            return redirect()->back()
                ->with('success', 'Rezultatul a fost trimis pe Telegram.');
        }

        return redirect()->back()
            ->with('error', 'Eroare la trimiterea rezultatului: ' . ($results[$channelType]['error'] ?? 'Unknown'));
    }
}

