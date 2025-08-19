<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'start_date',
        'end_date',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_available' => 'boolean',
        ];
    }

    /**
     * Get the room that owns this availability
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Scope for available periods
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope for unavailable periods
     */
    public function scopeUnavailable($query)
    {
        return $query->where('is_available', false);
    }

    /**
     * Scope for availability within date range
     */
    public function scopeWithinPeriod($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('start_date', [$startDate, $endDate])
              ->orWhereBetween('end_date', [$startDate, $endDate])
              ->orWhere(function ($query) use ($startDate, $endDate) {
                  $query->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
              });
        });
    }

    /**
     * Scope for current and future availability
     */
    public function scopeCurrent($query)
    {
        return $query->where('end_date', '>=', now()->toDateString());
    }

    /**
     * Scope for past availability
     */
    public function scopePast($query)
    {
        return $query->where('end_date', '<', now()->toDateString());
    }

    /**
     * Check if dates overlap with this availability period
     */
    public function overlaps($startDate, $endDate): bool
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        return $start->lte($this->end_date) && $end->gte($this->start_date);
    }

    /**
     * Check if dates are completely within this availability period
     */
    public function contains($startDate, $endDate): bool
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        return $start->gte($this->start_date) && $end->lte($this->end_date);
    }

    /**
     * Get number of days in this availability period
     */
    public function getDurationAttribute(): int
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    /**
     * Check if availability period is active (current or future)
     */
    public function isActive(): bool
    {
        return $this->end_date->gte(now()->toDateString());
    }

    /**
     * Mark period as unavailable
     */
    public function markUnavailable(): bool
    {
        return $this->update(['is_available' => false]);
    }

    /**
     * Mark period as available
     */
    public function markAvailable(): bool
    {
        return $this->update(['is_available' => true]);
    }
}