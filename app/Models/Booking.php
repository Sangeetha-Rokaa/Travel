<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    const PAYMENT_STATUSES = ['pending', 'partial', 'paid', 'refunded'];

    const BOOKING_STATUSES = [
        'pending'     => 'Pending',
        'confirmed'   => 'Confirmed',
        'in_progress' => 'In Progress',
        'completed'   => 'Completed',
        'cancelled'   => 'Cancelled',
        'refunded'    => 'Refunded',
    ];

    const BOOKING_TYPES = [
        'trek'    => 'Trek',
        'package' => 'Package',
        'custom'  => 'Custom Request',
    ];

    protected $fillable = [
        'booking_ref',
        'booking_type',
        'trek_id',
        'package_id',
        'custom_request',
        'first_name',
        'last_name',
        'email',
        'phone',
        'nationality',
        'passport_number',
        'date_of_birth',
        'trip_start_date',
        'trip_end_date',
        'num_adults',
        'num_children',
        'special_requirements',
        'accommodation_preference',
        'pickup_location',
        'base_price',
        'discount_amount',
        'total_price',
        'currency',
        'payment_status',
        'amount_paid',
        'payment_method',
        'transaction_id',
        'paid_at',
        'status',
        'admin_notes',
        'cancellation_reason',
        'confirmed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'trip_start_date' => 'date',
        'trip_end_date'   => 'date',
        'date_of_birth'   => 'date',
        'paid_at'         => 'datetime',
        'confirmed_at'    => 'datetime',
        'cancelled_at'    => 'datetime',
        'base_price'      => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_price'     => 'decimal:2',
        'amount_paid'     => 'decimal:2',
    ];

    // ── Relationships ────────────────────────────────────
    public function trek(): BelongsTo
    {
        return $this->belongsTo(Trek::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ── Helpers ──────────────────────────────────────────
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public static function generateRef(): string
    {
        $year = date('Y');
        $last = static::whereYear('created_at', $year)->count() + 1;
        return 'VN-' . $year . '-' . str_pad($last, 5, '0', STR_PAD_LEFT);
    }

    public function confirm(): void
    {
        $this->update(['status' => 'confirmed', 'confirmed_at' => now()]);
    }

    public function cancel(string $reason): void
    {
        $this->update([
            'status'              => 'cancelled',
            'cancellation_reason' => $reason,
            'cancelled_at'        => now(),
        ]);
    }

    public function markAsPaid(float $amount, string $method, ?string $txnId = null): void
    {
        $this->update([
            'amount_paid'      => $amount,
            'payment_method'   => $method,
            'transaction_id'   => $txnId,
            'payment_status'   => $amount >= $this->total_price ? 'paid' : 'partial',
            'paid_at'          => now(),
        ]);
    }

    public function markAsCompleted(): void
    {
        $this->update(['status' => 'completed']);
    }
}
