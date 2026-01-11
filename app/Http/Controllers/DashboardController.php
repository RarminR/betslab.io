<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $activeSubscription = $user->activeSubscription;

        // Get recent tips
        $recentTips = Tip::published()
            ->with('selections')
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        // Statistics
        $stats = [
            'total_tips' => Tip::published()->count(),
            'won' => Tip::published()->where('result', 'won')->count(),
            'lost' => Tip::published()->where('result', 'lost')->count(),
            'win_rate' => Tip::getWinRate(),
        ];

        return view('dashboard', [
            'activeSubscription' => $activeSubscription,
            'recentTips' => $recentTips,
            'stats' => $stats,
        ]);
    }
}

