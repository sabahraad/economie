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
        Schema::create('userdatas', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('raisonSociale')->nullable();
            $table->string('formeJuridique')->nullable();
            $table->date('dateCreation')->nullable();
            $table->integer('effectif')->nullable();
            $table->string('siret')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('codePostal')->nullable();
            $table->string('genre')->nullable();
            $table->string('prenom')->nullable();
            $table->string('nom')->nullable();
            $table->string('paysNaissance')->nullable();
            $table->string('villeNaissance')->nullable();
            $table->string('codePostalNaissance')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->string('nationaliteNaissance')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('cniRecto')->nullable(); 
            $table->string('cniVerso')->nullable(); 
            $table->string('cniSupplementaire')->nullable(); 
            $table->string('justifcatifDomicile')->nullable();
            $table->string('selfie')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userdatas');
    }
};
