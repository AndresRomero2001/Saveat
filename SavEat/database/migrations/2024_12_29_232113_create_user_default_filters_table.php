<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_default_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('main_tag_id')->nullable()->constrained('tags')->onDelete('set null');
            $table->foreignId('main_location_tag_id')->nullable()->constrained('tags')->onDelete('set null');
            $table->decimal('rating', 2, 1)->nullable();
            $table->json('price_ranges')->nullable();
            $table->json('tag_ids')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_default_filters');
    }
};
