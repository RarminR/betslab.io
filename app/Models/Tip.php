<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'sport',
        'total_odds',
        'stake',
        'status',
        'result',
        'is_published',
        'published_at',
        'telegram_sent',
        'channel_type',
        'analysis',
    ];

    protected function casts(): array
    {
        return [
            'total_odds' => 'decimal:2',
            'stake' => 'integer',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'telegram_sent' => 'boolean',
        ];
    }

    /**
     * Get the admin who created this tip.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get selections for this tip.
     */
    public function selections(): HasMany
    {
        return $this->hasMany(TipSelection::class)->orderBy('sort_order');
    }

    /**
     * Scope to get only published tips.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope to get only unpublished tips.
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Scope to get tips by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get tips by result.
     */
    public function scopeByResult($query, string $result)
    {
        return $query->where('result', $result);
    }

    /**
     * Scope to get tips for a specific sport.
     */
    public function scopeForSport($query, string $sport)
    {
        return $query->where('sport', $sport);
    }

    /**
     * Scope to get recent tips.
     */
    public function scopeRecent($query, int $limit = 10)
    {
        return $query->published()
            ->orderByDesc('published_at')
            ->limit($limit);
    }

    /**
     * Publish the tip.
     */
    public function publish(): void
    {
        $this->update([
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    /**
     * Unpublish the tip.
     */
    public function unpublish(): void
    {
        $this->update([
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    /**
     * Mark as sent to Telegram.
     */
    public function markAsTelegramSent(): void
    {
        $this->update(['telegram_sent' => true]);
    }

    /**
     * Calculate total odds from selections.
     */
    public function calculateTotalOdds(): float
    {
        $totalOdds = $this->selections->reduce(function ($carry, $selection) {
            return $carry * $selection->odds;
        }, 1.0);

        $this->update(['total_odds' => round($totalOdds, 2)]);

        return $totalOdds;
    }

    /**
     * Update result based on selections.
     */
    public function updateResultFromSelections(): void
    {
        $selections = $this->selections;

        if ($selections->isEmpty()) {
            return;
        }

        // If any selection is still pending, tip is pending
        if ($selections->where('result', 'pending')->isNotEmpty()) {
            $this->update(['status' => 'pending', 'result' => 'pending']);
            return;
        }

        // If any selection is void, check remaining
        $nonVoidSelections = $selections->where('result', '!=', 'void');

        if ($nonVoidSelections->isEmpty()) {
            $this->update(['status' => 'void', 'result' => 'void']);
            return;
        }

        // If any non-void selection lost, tip is lost
        if ($nonVoidSelections->where('result', 'lost')->isNotEmpty()) {
            $this->update(['status' => 'lost', 'result' => 'lost']);
            return;
        }

        // All non-void selections won
        if ($nonVoidSelections->where('result', 'won')->count() === $nonVoidSelections->count()) {
            $status = $selections->where('result', 'void')->isNotEmpty() ? 'partial' : 'won';
            $this->update(['status' => $status, 'result' => 'won']);
            return;
        }
    }

    /**
     * Get win rate for tips by this creator.
     */
    public static function getWinRate(?int $creatorId = null): float
    {
        $query = static::where('result', '!=', 'pending')
            ->where('result', '!=', 'void');

        if ($creatorId) {
            $query->where('created_by', $creatorId);
        }

        $total = $query->count();
        if ($total === 0) {
            return 0;
        }

        $won = (clone $query)->where('result', 'won')->count();

        return round(($won / $total) * 100, 1);
    }

    /**
     * Get stake display (visual representation).
     */
    public function getStakeDisplayAttribute(): string
    {
        return str_repeat('⭐', $this->stake);
    }

    /**
     * Get status badge class.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->result) {
            'won' => 'bg-green-100 text-green-800',
            'lost' => 'bg-red-100 text-red-800',
            'void' => 'bg-gray-100 text-gray-800',
            default => 'bg-yellow-100 text-yellow-800',
        };
    }

    /**
     * Check if this is a VIP tip.
     */
    public function isVip(): bool
    {
        return $this->channel_type === 'vip';
    }

    /**
     * Check if this is a free tip.
     */
    public function isFree(): bool
    {
        return $this->channel_type === 'free';
    }

    /**
     * Scope to get VIP tips only.
     */
    public function scopeVip($query)
    {
        return $query->where('channel_type', 'vip');
    }

    /**
     * Scope to get free tips only.
     */
    public function scopeFree($query)
    {
        return $query->where('channel_type', 'free');
    }
}

