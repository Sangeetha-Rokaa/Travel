<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trek extends Model
{
    protected $fillable = [
        'destination_id',
        'name',
        'slug',
        'short_description',
        'description',
        'difficulty',
        'duration_days',
        'max_altitude',
        'start_point',
        'end_point',
        'best_season',
        'price_usd',
        'group_size_min',
        'group_size_max',
        'highlights',
        'itinerary',
        'included',
        'excluded',
        'required_gear',
        'featured_image',
        'gallery_images',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'highlights'      => 'array',
        'itinerary'       => 'array',
        'included'        => 'array',
        'excluded'        => 'array',
        'required_gear'   => 'array',
        'gallery_images'  => 'array',
        'is_featured'     => 'boolean',
        'is_active'       => 'boolean',
        'price_usd'       => 'decimal:2',
    ];

    const DIFFICULTIES = [
        'Easy',
        'Moderate',
        'Strenuous',
        'Extreme',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function difficultyColor(): string
    {
        return match (strtolower($this->difficulty)) {
            'easy'      => '#22c55e',
            'moderate'  => '#f59e0b',
            'strenuous' => '#ef4444',
            'extreme'   => '#7c3aed',
            default     => '#6b7280',
        };
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query
            ->orderBy('sort_order')
            ->latest();
    }

    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    /*
    |--------------------------------------------------------------------------
    | Route Model Binding
    |--------------------------------------------------------------------------
    */

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
