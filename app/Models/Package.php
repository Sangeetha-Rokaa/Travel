<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'short_description',
        'description',
        'duration_days',
        'price_usd',
        'price_usd_discounted',
        'best_season',
        'group_size_max',
        'destinations_covered',
        'highlights',
        'itinerary',
        'included',
        'excluded',
        'featured_image',
        'gallery_images',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'destinations_covered' => 'array',
        'highlights'           => 'array',
        'itinerary'            => 'array',
        'included'             => 'array',
        'excluded'             => 'array',
        'gallery_images'       => 'array',
        'is_featured'          => 'boolean',
        'is_active'            => 'boolean',
        'price_usd'            => 'decimal:2',
        'price_usd_discounted' => 'decimal:2',
    ];

    const TYPES = [
        'cultural'   => 'Cultural Tour',
        'adventure'  => 'Adventure',
        'wildlife'   => 'Wildlife Safari',
        'pilgrimage' => 'Pilgrimage',
        'honeymoon'  => 'Honeymoon',
        'family'     => 'Family Tour',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
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

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
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

    public function getDiscountPercentageAttribute(): ?int
    {
        if ($this->price_usd_discounted && $this->price_usd > 0) {
            return (int) round((($this->price_usd - $this->price_usd_discounted) / $this->price_usd) * 100);
        }
        return null;
    }

    public function getEffectivePriceAttribute()
    {
        return $this->price_usd_discounted ?? $this->price_usd;
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst($this->type);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
