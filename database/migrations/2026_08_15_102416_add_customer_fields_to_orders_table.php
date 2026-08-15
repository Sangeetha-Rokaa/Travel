<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->nullable()->change(); // keep as-is if already unique/non-null
            $table->string('full_name')->after('user_id');
            $table->string('email')->after('full_name');
            $table->string('phone')->after('email');
            $table->string('city')->nullable()->after('phone');
            $table->string('payment_method')->default('cod')->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'email', 'phone', 'city', 'payment_method']);
        });
    }
};
