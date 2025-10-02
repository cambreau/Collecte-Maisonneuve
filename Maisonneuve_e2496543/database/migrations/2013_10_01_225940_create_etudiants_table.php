<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id(); // ou $table->bigIncrements('idEtudiant');
            $table->string('nom');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('email');
            $table->date('date_naissance');
            $table->unsignedBigInteger('ville');
            $table->timestamps();
    
            $table->foreign('ville')->references('id')->on('villes')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
