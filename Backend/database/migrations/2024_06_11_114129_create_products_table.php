<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productname'); // Correction de la faute de frappe et utilisation du snake_case
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2); // Utilisation du type correct pour les prix
            $table->text('description'); // Utilisation du type text pour des descriptions longues
            $table->decimal('quantity', 10, 2);
            $table->decimal('weight', 10, 2)->nullable(); // Ajout de la précision pour le poids
            $table->decimal('size', 10, 2)->nullable(); // Ajout de la précision pour la taille
            $table->boolean('is_available'); // Utilisation du type boolean pour un champ booléen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
