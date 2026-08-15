<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type'); // cultural, adventure, wildlife, pilgrimage, honeymoon, family
            $table->text('short_description');
            $table->longText('description');
            $table->integer('duration_days');
            $table->decimal('price_usd', 10, 2);
            $table->decimal('price_usd_discounted', 10, 2)->nullable();
            $table->string('best_season')->nullable();
            $table->integer('group_size_max')->default(20);
            $table->json('destinations_covered')->nullable(); // Array of destination names
            $table->json('highlights')->nullable();
            $table->json('itinerary')->nullable();
            $table->json('included')->nullable();
            $table->json('excluded')->nullable();
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
        Schema::dropIfExists('packages');
    }
};
