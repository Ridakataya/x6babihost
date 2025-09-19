<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'traveler_id',
        'room_id',
        'property_id',
        'rating',
        'comment',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
        ];
    }

    /**
     * Get the user who wrote this review
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'traveler_id');
    }

    /**
     * Get the room being reviewed
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the property being reviewed
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Scope for reviews with minimum rating
     */
    public function scopeMinRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }

    /**
     * Scope for reviews with specific rating
     */
    public function scopeRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope for reviews with comments
     */
    public function scopeWithComments($query)
    {
        return $query->whereNotNull('comment')
                     ->where('comment', '!=', '');
    }

    /**
     * Scope for recent reviews
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Get rating display with stars
     */
    public function getRatingStarsAttribute(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Get rating color class for CSS
     */
    public function getRatingColorAttribute(): string
    {
        return match(true) {
            $this->rating >= 4 => 'text-green-500',
            $this->rating >= 3 => 'text-yellow-500',
            default => 'text-red-500'
        };
    }

    /**
     * Get short excerpt of comment
     */
    public function getCommentExcerptAttribute(): string
    {
        if (!$this->comment) {
            return '';
        }
        
        return strlen($this->comment) > 100 
            ? substr($this->comment, 0, 100) . '...' 
            : $this->comment;
    }

    /**
     * Check if review is positive (4-5 stars)
     */
    public function isPositive(): bool
    {
        return $this->rating >= 4;
    }

    /**
     * Check if review is negative (1-2 stars)
     */
    public function isNegative(): bool
    {
        return $this->rating <= 2;
    }

    /**
     * Check if review is neutral (3 stars)
     */
    public function isNeutral(): bool
    {
        return $this->rating === 3;
    }
}
