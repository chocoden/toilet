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
        Schema::create('toilets', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('title');
            $table->string('photo_url')->nullable();
            $table->foreignID('function_id')->constrained()->cascadeOnDelete();
            $table->string('opening_hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignID('user_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toilets');
    }
};
