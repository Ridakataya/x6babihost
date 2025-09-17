<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
    {
    use HasFactory, Notifiable,HAsApiTokens;

    /**
         * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User role constants
    const ROLE_TRAVELER = 'traveler';
    const ROLE_HOST = 'host';
    const ROLE_ADMIN = 'admin';

    /**
     * Check if user is a traveler
     */
    public function isTraveler(): bool
    {
        return $this->role === self::ROLE_TRAVELER;
    }

    /**
     * Check if user is a host
     */
    public function isHost(): bool
    {
        return $this->role === self::ROLE_HOST;
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Get all properties owned by this user (for hosts)
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'host_id');
    }

    /**
     * Get all bookings made by this user (for travelers)
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class , 'traveler_id');
    }

    /**
     * Get all reviews written by this user
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class , 'traveler_id');
    }

    /**
     * Get host verification records for this user
     */
    public function hosts(): HasMany
    {
        return $this->hasMany(Host::class);
    }

    /**
     * Get the latest host verification record
     */
    public function latestHosts(): HasOne
    {
        return $this->hasOne(Host::class)->latestOfMany();
    }

    /**
     * Get favorite properties for this user
     */
    public function favoriteProperties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'favorites')
                    ->withTimestamps();
    }

    /**
     * Scope for filtering users by role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope for hosts only
     */
    public function scopeHosts($query)
    {
        return $query->byRole(self::ROLE_HOST);
    }

    /**
     * Scope for travelers only
     */
    public function scopeTravelers($query)
    {
        return $query->byRole(self::ROLE_TRAVELER);
    }

    /**
     * Scope for admins only
     */
    public function scopeAdmins($query)
    {
        return $query->byRole(self::ROLE_ADMIN);
    }
}