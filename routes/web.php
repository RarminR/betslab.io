<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentWebhookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\TipController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/pricing', [SubscriptionController::class, 'pricing'])->name('pricing');
Route::get('/tips', [TipController::class, 'index'])->name('tips.index');

// Payment webhooks (no CSRF)
Route::post('/webhooks/netopia', [PaymentWebhookController::class, 'netopia'])
    ->name('webhooks.netopia')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/webhooks/revolut', [PaymentWebhookController::class, 'revolut'])
    ->name('webhooks.revolut')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Subscription
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::get('/payment/return', [SubscriptionController::class, 'return'])->name('payment.return');
    Route::post('/subscription/{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');

    // Telegram - Free channel (available to all registered users)
    Route::get('/telegram/free', [TelegramController::class, 'free'])->name('telegram.free');
    Route::get('/telegram', [TelegramController::class, 'access'])->name('telegram.access');

    // Subscriber-only routes
    Route::middleware('subscribed')->group(function () {
        Route::get('/tips/{tip}', [TipController::class, 'show'])->name('tips.show');
        Route::get('/telegram/vip', [TelegramController::class, 'vip'])->name('telegram.vip');
    });
});

// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'admin'])
    ->group(function () {
        require __DIR__.'/admin.php';
    });

require __DIR__.'/auth.php';
