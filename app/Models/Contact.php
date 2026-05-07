<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'subject',
        'message',
        'inquiry_type',
        'trek_or_package',
        'travel_date',
        'group_size',
        'status',
        'admin_notes',
        'replied_at',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'replied_at'  => 'datetime',
    ];

    const STATUSES = ['new', 'read', 'replied', 'closed'];
    const INQUIRY_TYPES = ['general', 'trek', 'package', 'custom'];

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'new'     => 'blue',
            'read'    => 'yellow',
            'replied' => 'green',
            'closed'  => 'gray',
            default   => 'gray',
        };
    }
}
