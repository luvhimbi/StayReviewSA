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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->string('title');
            $table->text('review');
            $table->tinyInteger('cleanliness')->unsigned()->checkBetween(1, 5);
            $table->tinyInteger('location')->unsigned()->checkBetween(1, 5);
            $table->tinyInteger('price')->unsigned()->checkBetween(1, 5);
            $table->decimal('overall_rating', 2, 1)->storedAs('((cleanliness + location + price) / 3)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
