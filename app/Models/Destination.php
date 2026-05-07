<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'location',
        'region',
        'altitude',
        'best_season',
        'featured_image',
        'gallery_images',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
    ];

    // Auto-generate slug from name
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

    public function treks()
    {
        return $this->hasMany(Trek::class);
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // ─── Accessors ───────────────────────────────────────────────────────────────

    public function getFeaturedImageUrlAttribute(): string
    {
        return asset('storage/' . $this->featured_image);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
