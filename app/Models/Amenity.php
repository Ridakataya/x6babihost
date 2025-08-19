<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    /**
     * Get rooms that have this amenity
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room_amenities')
                    ->withTimestamps();
    }

    /**
     * Scope for amenities by name
     */
    public function scopeByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Get amenity display with icon
     */
    public function getDisplayAttribute(): string
    {
        return $this->icon ? $this->icon . ' ' . $this->name : $this->name;
    }

    /**
     * Get popular amenities (used by most rooms)
     */
    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('rooms')
                     ->orderBy('rooms_count', 'desc')
                     ->limit($limit);
    }
}
