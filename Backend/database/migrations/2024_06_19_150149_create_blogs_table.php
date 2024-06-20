<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('BlogTitle', 75);
            $table->text('BlogDescription');
            $table->unsignedBigInteger('BlogAuthor'); // Assurez-vous que le type correspond
            $table->foreign('BlogAuthor')->references('EmployeeId')->on('employees')->onDelete('cascade'); // Ajout de onDelete('cascade') pour une suppression en cascade, si nécessaire
            $table->boolean('BlogVisibility');
            $table->date('BlogDate');
            $table->string('BlogImg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
