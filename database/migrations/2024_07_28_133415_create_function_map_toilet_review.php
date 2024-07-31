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
        Schema::create('function_map_toilet_review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('function_id')->constrained()->onDelete('cascade');
            $table->foreignId('map_toilet_review_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_map_toilet_review');
    }
};
