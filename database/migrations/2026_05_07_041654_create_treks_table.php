<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable()->constrained('destinations')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description');
            $table->string('difficulty'); // Easy, Moderate, Strenuous, Extreme
            $table->integer('duration_days');
            $table->string('max_altitude')->nullable();
            $table->string('start_point');
            $table->string('end_point');
            $table->string('best_season')->nullable();
            $table->decimal('price_usd', 10, 2)->nullable();
            $table->integer('group_size_min')->default(1);
            $table->integer('group_size_max')->default(16);
            $table->json('highlights')->nullable();       // JSON array of highlight strings
            $table->json('itinerary')->nullable();        // JSON array of day-by-day plan
            $table->json('included')->nullable();         // What's included
            $table->json('excluded')->nullable();         // What's excluded
            $table->json('required_gear')->nullable();
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treks');
    }
};
