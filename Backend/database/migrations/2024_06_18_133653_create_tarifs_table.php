<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->id();
            $table->string('exp_zone');
            $table->string('del_duration');
            $table->integer('max_pound');
            $table->integer('min_pound');
            $table->integer('tarif_price');
            $table->foreignId('deliveryId')->constrained('deliveries'); // Utilisez foreignId pour les relations avec d'autres tables

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifs');
    }
};
