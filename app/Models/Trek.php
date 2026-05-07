<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Trek extends Model
{
    use HasFactory;

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
        'highlights'    => 'array',
        'itinerary'     => 'array',
        'included'      => 'array',
        'excluded'      => 'array',
        'required_gear' => 'array',
        'gallery_images' => 'array',
        'is_featured'   => 'boolean',
        'is_active'     => 'boolean',
        'price_usd'     => 'decimal:2',
    ];

    const DIFFICULTIES = ['Easy', 'Moderate', 'Strenuous', 'Extreme'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // ─── Relationships ───────────────────────────────────────────────────────────

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByDifficulty($query, string $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // ─── Accessors ───────────────────────────────────────────────────────────────

    public function getFeaturedImageUrlAttribute(): string
    {
        return asset('storage/' . $this->featured_image);
    }

    public function getDifficultyColorAttribute(): string
    {
        return match ($this->difficulty) {
            'Easy'      => 'green',
            'Moderate'  => 'yellow',
            'Strenuous' => 'orange',
            'Extreme'   => 'red',
            default     => 'gray',
        };
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
