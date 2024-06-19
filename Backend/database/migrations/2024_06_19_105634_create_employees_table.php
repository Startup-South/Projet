<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('EmployeeId'); // EmployeeId (Id employé)
            $table->string('EmployeeFirstname', 100); // EmployeeFirstname (Nom employé)
            $table->string('EmployeeLastname', 100); // EmployeeLastname (Prénom employé)
            $table->string('EmployeeEmail', 50)->unique(); // EmployeeEmail (Adresse mail)
            $table->boolean('IsEmployeeEmailVerified')->default(false); // IsEmployeeEmailVerified (Si l’email est verifié)
            $table->text('Autorisation')->nullable(); // Autorisation
            $table->integer('EmployeeRole'); // EmployeeRole (Rôle de l’employé)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
