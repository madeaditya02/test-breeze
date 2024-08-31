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
        Schema::create('places', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->json('types')->nullable();
            $table->string('address')->nullable();
            $table->string('province')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->double('rating')->nullable();
            $table->string('url')->nullable();
            $table->text('summary')->nullable();
            $table->string('photo')->nullable();      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
