<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

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
        'trip_end_date' => 'date',
        'date_of_birth' => 'date',
        'paid_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'base_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'num_adults' => 'integer',
        'num_children' => 'integer',
    ];

    // Constants for dropdowns
    const BOOKING_TYPES = ['trek', 'package', 'custom'];

    const PAYMENT_STATUSES = ['pending', 'partial', 'paid', 'refunded'];

    const BOOKING_STATUSES = [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'refunded' => 'Refunded'
    ];

    const ACCOMMODATION_PREFERENCES = ['budget', 'standard', 'luxury'];

    const CURRENCIES = ['USD', 'EUR', 'GBP', 'AUD', 'NPR'];

    // Relationships
    public function trek(): BelongsTo
    {
        return $this->belongsTo(Trek::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('trip_start_date', [$startDate, $endDate]);
    }

    // Boot method to generate booking reference
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_ref)) {
                $booking->booking_ref = self::generateBookingRef();
            }
        });
    }

    // Generate unique booking reference
    public static function generateBookingRef(): string
    {
        $year = date('Y');
        $prefix = 'NT'; // Nepal Travel

        // Get the last booking of the year
        $lastBooking = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastBooking && preg_match('/NT-' . $year . '-(\d+)/', $lastBooking->booking_ref, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
        } else {
            $nextNumber = 1;
        }

        $reference = sprintf('%s-%s-%05d', $prefix, $year, $nextNumber);

        // Ensure uniqueness (in case of race condition)
        while (self::where('booking_ref', $reference)->exists()) {
            $nextNumber++;
            $reference = sprintf('%s-%s-%05d', $prefix, $year, $nextNumber);
        }

        return $reference;
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getTotalPersonsAttribute(): int
    {
        return $this->num_adults + $this->num_children;
    }

    public function getRemainingAmountAttribute(): float
    {
        return max(0, $this->total_price - $this->amount_paid);
    }

    public function getPaymentPercentageAttribute(): float
    {
        if ($this->total_price <= 0) {
            return 0;
        }
        return min(100, ($this->amount_paid / $this->total_price) * 100);
    }

    public function getTripDurationAttribute(): ?int
    {
        if ($this->trip_end_date) {
            return $this->trip_start_date->diffInDays($this->trip_end_date);
        }
        return null;
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'confirmed' => 'info',
            'in_progress' => 'primary',
            'completed' => 'success',
            'cancelled' => 'danger',
            'refunded' => 'secondary',
            default => 'secondary',
        };
    }

    public function getPaymentStatusBadgeClassAttribute(): string
    {
        return match ($this->payment_status) {
            'pending' => 'warning',
            'partial' => 'info',
            'paid' => 'success',
            'refunded' => 'danger',
            default => 'secondary',
        };
    }

    // Helper methods
    public function confirm(): bool
    {
        $this->status = 'confirmed';
        $this->confirmed_at = now();
        return $this->save();
    }

    public function cancel(string $reason = null): bool
    {
        $this->status = 'cancelled';
        $this->cancelled_at = now();
        $this->cancellation_reason = $reason;
        return $this->save();
    }

    public function markAsPaid(float $amount = null, string $method = null, string $transactionId = null): bool
    {
        if ($amount !== null) {
            $this->amount_paid += $amount;
        }

        if ($this->amount_paid >= $this->total_price) {
            $this->payment_status = 'paid';
            $this->paid_at = now();
        } elseif ($this->amount_paid > 0) {
            $this->payment_status = 'partial';
        }

        if ($method) {
            $this->payment_method = $method;
        }

        if ($transactionId) {
            $this->transaction_id = $transactionId;
        }

        return $this->save();
    }

    public function markAsCompleted(): bool
    {
        $this->status = 'completed';
        return $this->save();
    }

    public function isOverdue(): bool
    {
        return $this->status === 'confirmed'
            && $this->payment_status !== 'paid'
            && $this->created_at->addDays(7)->isPast();
    }
}
