<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('del_name');
            $table->string('logo');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
