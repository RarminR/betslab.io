<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'action',
        'tip_id',
        'user_id',
        'response',
        'success',
        'error_message',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'response' => 'array',
            'success' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the tip associated with this log.
     */
    public function tip(): BelongsTo
    {
        return $this->belongsTo(Tip::class);
    }

    /**
     * Get the user associated with this log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get successful logs.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('success', true);
    }

    /**
     * Scope to get failed logs.
     */
    public function scopeFailed($query)
    {
        return $query->where('success', false);
    }

    /**
     * Scope to filter by action.
     */
    public function scopeForAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Create a successful log entry.
     */
    public static function logSuccess(string $action, array $response = [], ?int $tipId = null, ?int $userId = null): static
    {
        return static::create([
            'action' => $action,
            'tip_id' => $tipId,
            'user_id' => $userId,
            'response' => $response,
            'success' => true,
            'created_at' => now(),
        ]);
    }

    /**
     * Create a failed log entry.
     */
    public static function logFailure(string $action, string $errorMessage, array $response = [], ?int $tipId = null, ?int $userId = null): static
    {
        return static::create([
            'action' => $action,
            'tip_id' => $tipId,
            'user_id' => $userId,
            'response' => $response,
            'success' => false,
            'error_message' => $errorMessage,
            'created_at' => now(),
        ]);
    }
}

