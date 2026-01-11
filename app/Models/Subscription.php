<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'price',
        'starts_at',
        'ends_at',
        'telegram_synced',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'starts_at' => 'date',
            'ends_at' => 'date',
            'telegram_synced' => 'boolean',
        ];
    }

    /**
     * Get the user that owns this subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the plan for this subscription.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get payments for this subscription.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope to get only active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            });
    }

    /**
     * Scope to get expired subscriptions.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'active')
            ->whereNotNull('ends_at')
            ->where('ends_at', '<', now());
    }

    /**
     * Scope to get subscriptions expiring soon (within X days).
     */
    public function scopeExpiringSoon($query, int $days = 3)
    {
        return $query->where('status', 'active')
            ->whereNotNull('ends_at')
            ->whereBetween('ends_at', [now(), now()->addDays($days)]);
    }

    /**
     * Check if subscription is active.
     */
    public function isActive(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->ends_at === null) {
            return true; // Lifetime
        }

        return $this->ends_at->isFuture() || $this->ends_at->isToday();
    }

    /**
     * Check if this is a lifetime subscription.
     */
    public function isLifetime(): bool
    {
        return $this->ends_at === null && $this->status === 'active';
    }

    /**
     * Get days remaining.
     */
    public function getDaysRemainingAttribute(): ?int
    {
        if ($this->ends_at === null) {
            return null; // Lifetime
        }

        if ($this->ends_at->isPast()) {
            return 0;
        }

        return now()->diffInDays($this->ends_at);
    }

    /**
     * Activate the subscription.
     */
    public function activate(): void
    {
        $this->update([
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => $this->plan->is_lifetime ? null : now()->addDays($this->plan->duration_days),
        ]);
    }

    /**
     * Mark subscription as expired.
     */
    public function markAsExpired(): void
    {
        $this->update(['status' => 'expired']);
    }

    /**
     * Cancel the subscription.
     */
    public function cancel(): void
    {
        $this->update(['status' => 'cancelled']);
    }
}

