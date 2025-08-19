<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'room_type',
        'description',
        'capacity',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'price' => 'decimal:2',
        ];
    }

    /**
     * Get the property that owns this room
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get all bookings for this room
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all availabilities for this room
     */
    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }

    /**
     * Get all reviews for this room
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get amenities for this room
     */
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'room_amenities')
                    ->withTimestamps();
    }

    /**
     * Scope for rooms with specific capacity or more
     */
    public function scopeMinCapacity($query, $capacity)
    {
        return $query->where('capacity', '>=', $capacity);
    }

    /**
     * Scope for rooms within price range
     */
    public function scopePriceRange($query, $minPrice = null, $maxPrice = null)
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }
        
        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
        
        return $query;
    }

    /**
     * Scope for rooms by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('room_type', 'like', '%' . $type . '%');
    }

    /**
     * Check if room is available for given date range
     */
    public function isAvailable($startDate, $endDate)
    {
        return $this->availabilities()
                    ->where('is_available', true)
                    ->where('start_date', '<=', $startDate)
                    ->where('end_date', '>=', $endDate)
                    ->exists();
    }

    /**
     * Get confirmed bookings for date range
     */
    public function getBookingsForPeriod($startDate, $endDate)
    {
        return $this->bookings()
                    ->where('status', Booking::STATUS_CONFIRMED)
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('check_in', [$startDate, $endDate])
                              ->orWhereBetween('check_out', [$startDate, $endDate])
                              ->orWhere(function ($q) use ($startDate, $endDate) {
                                  $q->where('check_in', '<=', $startDate)
                                    ->where('check_out', '>=', $endDate);
                              });
                    });
    }

    /**
     * Get average rating for this room
     */
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }

    /**
     * Get total number of reviews for this room
     */
    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }

    /**
     * Calculate total price for given number of nights
     */
    public function calculatePrice($nights)
    {
        return $this->price * $nights;
    }

    /**
     * Get room name (type + property title)
     */
    public function getNameAttribute()
    {
        return $this->room_type . ' - ' . $this->property->title;
    }
}
