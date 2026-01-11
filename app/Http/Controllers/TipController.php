<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipController extends Controller
{
    /**
     * Display a listing of tips (public - limited info).
     */
    public function index(Request $request)
    {
        $tips = Tip::published()
            ->with('selections')
            ->orderByDesc('published_at')
            ->paginate(12);

        // Calculate statistics
        $stats = [
            'total_tips' => Tip::published()->count(),
            'won' => Tip::published()->where('result', 'won')->count(),
            'lost' => Tip::published()->where('result', 'lost')->count(),
            'pending' => Tip::published()->where('result', 'pending')->count(),
            'win_rate' => Tip::getWinRate(),
        ];

        return view('tips.index', [
            'tips' => $tips,
            'stats' => $stats,
        ]);
    }

    /**
     * Display the specified tip (subscribers only).
     */
    public function show(Tip $tip)
    {
        if (!$tip->is_published) {
            abort(404);
        }

        $tip->load('selections', 'creator');

        return view('tips.show', [
            'tip' => $tip,
        ]);
    }
}

