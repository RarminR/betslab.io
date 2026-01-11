<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\AdminTipController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Models\TipSelection;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

// Tips
Route::resource('tips', AdminTipController::class);
Route::post('/tips/{tip}/publish', [AdminTipController::class, 'publish'])->name('tips.publish');
Route::post('/tips/{tip}/unpublish', [AdminTipController::class, 'unpublish'])->name('tips.unpublish');
Route::post('/tips/{tip}/send-result', [AdminTipController::class, 'sendResult'])->name('tips.send-result');
Route::patch('/selections/{selection}/result', [AdminTipController::class, 'updateSelectionResult'])->name('selections.update-result');

// Users
Route::resource('users', AdminUserController::class)->except(['create', 'store']);
Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');

// Subscriptions
Route::resource('subscriptions', AdminSubscriptionController::class);
Route::post('/subscriptions/{subscription}/activate', [AdminSubscriptionController::class, 'activate'])->name('subscriptions.activate');
Route::post('/subscriptions/{subscription}/expire', [AdminSubscriptionController::class, 'expire'])->name('subscriptions.expire');
Route::post('/subscriptions/{subscription}/cancel', [AdminSubscriptionController::class, 'cancel'])->name('subscriptions.cancel');

