<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Tip;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        $plans = Plan::where('is_active', true)->get();

        // Get recent tips for public display (limited info)
        $latestTips = Tip::where('status', 'published')
            ->orWhere('status', 'won')
            ->orWhere('status', 'lost')
            ->with('selections')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('home', [
            'plans' => $plans,
            'latestTips' => $latestTips,
        ]);
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('about');
    }
}

