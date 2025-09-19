<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'traveler_id',
        'room_id',
        'check_in',
        'check_out',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'check_in' => 'date',
            'check_out' => 'date',
            'total_price' => 'decimal:2',
        ];
    }

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Get the user that made this booking
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'traveler_id');
    }

    /**
     * Get the room for this booking
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the payment for this booking
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the property through room relationship
     */
    public function property()
    {
        return $this->room->property ?? null;
    }

    /**
     * Scope for pending bookings
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for confirmed bookings
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * Scope for cancelled bookings
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    /**
     * Scope for current bookings (ongoing)
     */
    public function scopeCurrent($query)
    {
        $today = now()->toDateString();
        return $query->where('check_in', '<=', $today)
                     ->where('check_out', '>', $today)
                     ->confirmed();
    }

    /**
     * Scope for upcoming bookings
     */
    public function scopeUpcoming($query)
    {
        return $query->where('check_in', '>', now()->toDateString())
                     ->confirmed();
    }

    /**
     * Scope for past bookings
     */
    public function scopePast($query)
    {
        return $query->where('check_out', '<=', now()->toDateString())
                     ->confirmed();
    }

    /**
     * Scope for bookings within date range
     */
    public function scopeWithinPeriod($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('check_in', [$startDate, $endDate])
              ->orWhereBetween('check_out', [$startDate, $endDate])
              ->orWhere(function ($query) use ($startDate, $endDate) {
                  $query->where('check_in', '<=', $startDate)
                        ->where('check_out', '>=', $endDate);
              });
        });
    }

    /**
     * Check if booking is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if booking is confirmed
     */
    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    /**
     * Check if booking is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Check if booking is current (guest is currently staying)
     */
    public function isCurrent(): bool
    {
        $today = now()->toDateString();
        return $this->isConfirmed() && 
               $this->check_in <= $today && 
               $this->check_out > $today;
    }

    /**
     * Check if booking is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->isConfirmed() && $this->check_in > now()->toDateString();
    }

    /**
     * Check if booking is past
     */
    public function isPast(): bool
    {
        return $this->isConfirmed() && $this->check_out <= now()->toDateString();
    }

    /**
     * Get number of nights for this booking
     */
    public function getNightsAttribute(): int
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    /**
     * Get total duration in days
     */
    public function getDurationAttribute(): int
    {
        return $this->nights;
    }

    /**
     * Confirm the booking
     */
    public function confirm(): bool
    {
        return $this->update(['status' => self::STATUS_CONFIRMED]);
    }

    /**
     * Cancel the booking
     */
    public function cancel(): bool
    {
        return $this->update(['status' => self::STATUS_CANCELLED]);
    }

    /**
     * Calculate and set total price based on room price and nights
     */
    public function calculateTotalPrice(): self
    {
        if ($this->room) {
            $this->total_price = $this->room->price * $this->nights;
        }
        return $this;
    }

    /**
     * Check if booking can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return $this->isPending() || ($this->isConfirmed() && $this->check_in > now());
    }
}