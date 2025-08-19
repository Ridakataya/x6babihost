<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_id',
        'title',
        'description',
        'address',
        'city',
        'country',
        'latitude',
        'longitude',
        'verified',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'verified' => 'boolean',
        ];
    }

    /**
     * Get the host that owns this property
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * Get all rooms for this property
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Get all reviews for this property
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get all bookings for this property through rooms
     */
    public function bookings(): HasManyThrough
    {
        return $this->hasManyThrough(Booking::class, Room::class);
    }

    /**
     * Get users who favorited this property
     */
    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }

    /**
     * Scope for verified properties
     */
    public function scopeVerified($query)
    {
        return $query->where('verified', true);
    }

    /**
     * Scope for unverified properties
     */
    public function scopeUnverified($query)
    {
        return $query->where('verified', false);
    }

    /**
     * Scope for properties in a specific city
     */
    public function scopeInCity($query, $city)
    {
        return $query->where('city', 'like', '%' . $city . '%');
    }

    /**
     * Scope for properties in a specific country
     */
    public function scopeInCountry($query, $country)
    {
        return $query->where('country', 'like', '%' . $country . '%');
    }

    /**
     * Get the minimum price among all rooms
     */
    public function getMinPriceAttribute()
    {
        return $this->rooms()->min('price') ?? 0;
    }

    /**
     * Get the maximum price among all rooms
     */
    public function getMaxPriceAttribute()
    {
        return $this->rooms()->max('price') ?? 0;
    }

    /**
     * Get average rating for this property
     */
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }

    /**
     * Get total number of reviews
     */
    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }

    /**
     * Get total capacity of all rooms combined
     */
    public function getTotalCapacityAttribute()
    {
        return $this->rooms()->sum('capacity');
    }

    /**
     * Check if property has available rooms for given dates
     */
    public function hasAvailableRooms($startDate, $endDate)
    {
        return $this->rooms()->whereHas('availabilities', function ($query) use ($startDate, $endDate) {
            $query->where('is_available', true)
                  ->where('start_date', '<=', $startDate)
                  ->where('end_date', '>=', $endDate);
        })->exists();
    }

    /**
     * Get full address string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->country}";
    }
}
