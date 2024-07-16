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
        Schema::create('parking_lots', function (Blueprint $table)
        {
            $table->id();
            $table->text('description')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->json('coordinates');
            $table->integer('total_capacity');
            $table->string('polygon_color', 7)->default('#000000');
            $table->string('city');
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_lots');
    }
};
