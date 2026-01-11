<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Tip;
use App\Models\User;
use App\Services\SubscriptionService;

class AdminDashboardController extends Controller
{
    public function __construct(
        protected SubscriptionService $subscriptionService
    ) {}

    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'active_subscribers' => Subscription::active()->count(),
            'total_tips' => Tip::count(),
            'pending_tips' => Tip::where('result', 'pending')->count(),
            'won_tips' => Tip::where('result', 'won')->count(),
            'lost_tips' => Tip::where('result', 'lost')->count(),
            'win_rate' => Tip::getWinRate(),
            'total_revenue' => Payment::completed()->sum('amount'),
            'monthly_revenue' => Payment::completed()
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
        ];

        // Recent activities
        $recentSubscriptions = Subscription::with('user', 'plan')
            ->latest()
            ->limit(5)
            ->get();

        $recentPayments = Payment::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentTips = Tip::with('creator')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentSubscriptions' => $recentSubscriptions,
            'recentPayments' => $recentPayments,
            'recentTips' => $recentTips,
        ]);
    }
}

