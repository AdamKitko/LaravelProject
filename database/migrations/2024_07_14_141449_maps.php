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
        Schema::create('maps', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->double('latitude');
            $table->double('longitude');
            $table->double('latitude-south-west');
            $table->double('longitude-south-west');
            $table->double('longitude-north-east');
            $table->double('latitude-north-east');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maps');
    }
};
