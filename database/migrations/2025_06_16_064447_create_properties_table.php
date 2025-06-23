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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zipcode');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('price', 15, 2);
            $table->enum('type', ['apartment', 'house', 'land', 'commercial', 'villa', 'cottage'])->default('apartment');
            $table->enum('status', ['available', 'rented', 'sold', 'pending'])->default('available');
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('size')->nullable(); // sqm
            $table->year('year_built')->nullable();
            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('process_type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
