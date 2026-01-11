<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TipSelection extends Model
{
    use HasFactory;

    protected $fillable = [
        'tip_id',
        'event_name',
        'event_date',
        'league',
        'prediction',
        'odds',
        'result',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'odds' => 'decimal:2',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the tip this selection belongs to.
     */
    public function tip(): BelongsTo
    {
        return $this->belongsTo(Tip::class);
    }

    /**
     * Scope to get selections by result.
     */
    public function scopeByResult($query, string $result)
    {
        return $query->where('result', $result);
    }

    /**
     * Scope to get pending selections.
     */
    public function scopePending($query)
    {
        return $query->where('result', 'pending');
    }

    /**
     * Scope to get upcoming events.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>', now());
    }

    /**
     * Mark selection as won.
     */
    public function markAsWon(): void
    {
        $this->update(['result' => 'won']);
        $this->tip->updateResultFromSelections();
    }

    /**
     * Mark selection as lost.
     */
    public function markAsLost(): void
    {
        $this->update(['result' => 'lost']);
        $this->tip->updateResultFromSelections();
    }

    /**
     * Mark selection as void.
     */
    public function markAsVoid(): void
    {
        $this->update(['result' => 'void']);
        $this->tip->updateResultFromSelections();
    }

    /**
     * Get result badge class.
     */
    public function getResultBadgeClassAttribute(): string
    {
        return match ($this->result) {
            'won' => 'bg-green-100 text-green-800',
            'lost' => 'bg-red-100 text-red-800',
            'void' => 'bg-gray-100 text-gray-800',
            default => 'bg-yellow-100 text-yellow-800',
        };
    }

    /**
     * Get formatted event date.
     */
    public function getFormattedEventDateAttribute(): string
    {
        return $this->event_date->format('d M Y, H:i');
    }
}

