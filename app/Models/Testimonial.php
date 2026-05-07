<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_country',
        'client_photo',
        'trek_or_package',
        'rating',
        'review',
        'travel_date',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getClientPhotoUrlAttribute(): string
    {
        return $this->client_photo
            ? asset('storage/' . $this->client_photo)
            : asset('images/default-avatar.png');
    }
}
