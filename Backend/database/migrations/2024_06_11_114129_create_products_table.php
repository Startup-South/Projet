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
            $table->string('product_name'); // Nom du produit
            $table->string('product_img')->nullable(); // Image du produit
            $table->boolean('product_status'); // Statut du produit
            $table->integer('stock'); // Stock du produit
            $table->decimal('market_price', 8, 2); // Prix du marché
            $table->string('sale_channel')->nullable(); // Canal de vente
            $table->text('product_description')->nullable(); // Description du produit
            $table->string('product_type'); // Type de produit
            $table->decimal('product_pound', 8, 2)->nullable(); // Poids du produit
            $table->string('product_city_origin'); // Ville d'origine du produit
            $table->string('code_sh'); // Code SH
            $table->decimal('product_price', 8, 2); // Prix du produit
            $table->string('product_code'); // Code du produit
            $table->string('product_shop'); // Boutique du produit
            $table->string('product_options')->nullable(); // Options du produit
            $table->decimal('product_value', 8, 2)->nullable(); // Valeur du produit
            $table->timestamps(); // Horodatage
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
