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
        Schema::create('commands', function (Blueprint $table) {
            $table->id();
            $table->date('CommandDate'); // Utilisez le type date pour les dates
            $table->string('PaymentStatus');
            $table->string('CommandStatus');
            $table->string('DeliveryMode');
            $table->text('Comment')->nullable(); // Utilisez text pour des commentaires longs et nullable si optionnel
            $table->foreignId('ClientId')->constrained('clients'); // Utilisez foreignId pour les relations avec d'autres tables
            $table->foreignId('ProductId')->constrained('products'); // Utilisez foreignId pour les relations avec d'autres tables
            $table->foreignId('BillId')->constrained('bills'); // Utilisez foreignId pour les relations avec d'autres tables
            $table->integer('Article');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commands');
    }
};
