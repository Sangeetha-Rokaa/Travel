<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // ── Booking reference ─────────────────────────────────────────────
            $table->string('booking_ref')->unique();   // e.g. NT-2024-00123

            // ── What is being booked ──────────────────────────────────────────
            $table->enum('booking_type', ['trek', 'package', 'custom']);
            $table->foreignId('trek_id')->nullable()->constrained('treks')->nullOnDelete();
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->string('custom_request')->nullable(); // free-text for custom trips

            // ── Primary traveler ──────────────────────────────────────────────
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('date_of_birth')->nullable();

            // ── Trip details ──────────────────────────────────────────────────
            $table->date('trip_start_date');
            $table->date('trip_end_date')->nullable();
            $table->integer('num_adults')->default(1);
            $table->integer('num_children')->default(0);
            $table->text('special_requirements')->nullable();  // dietary, medical, etc.
            $table->string('accommodation_preference')->nullable(); // budget/standard/luxury
            $table->string('pickup_location')->nullable();

            // ── Pricing ───────────────────────────────────────────────────────
            $table->decimal('base_price', 10, 2);          // price at time of booking
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);
            $table->string('currency', 3)->default('USD');

            // ── Payment ───────────────────────────────────────────────────────
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded'])->default('pending');
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->string('payment_method')->nullable();    // bank_transfer, stripe, paypal, etc.
            $table->string('transaction_id')->nullable();
            $table->timestamp('paid_at')->nullable();

            // ── Booking status ────────────────────────────────────────────────
            $table->enum('status', [
                'pending',      // just submitted, awaiting confirmation
                'confirmed',    // admin confirmed
                'in_progress',  // trip is happening right now
                'completed',    // trip finished
                'cancelled',    // cancelled by client or admin
                'refunded',     // money returned
            ])->default('pending');

            $table->text('admin_notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
