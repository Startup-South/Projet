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
        Schema::create('clients', function (Blueprint $table) {
            $table->Id();
            $table->string('ClientFirstname');
            $table->string('ClientLastname');
            $table->date('date_naissance')->nullable();
            $table->string('ClientPhone')->nullable();
            $table->string('codePostale');
            $table->string('adresse_facturation');
            $table->string('adresse_livraison')->nullable();
            $table->string('adresse_email')->unique();
            $table->string('password');
            $table->enum('genre', ['Homme', 'Femme', 'Autre', 'Préférer ne pas dire'])->nullable();
            $table->boolean('Subscription')->default(false);
            $table->timestamp('date_inscription')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
