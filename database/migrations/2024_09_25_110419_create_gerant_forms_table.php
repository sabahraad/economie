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
        Schema::create('gerant_forms', function (Blueprint $table) {
            $table->id();
            $table->string('genre');
            $table->string('prenom');
            $table->string('nom');
            $table->string('paysNaissance');
            $table->string('villeNaissance');
            $table->string('codePostalNaissance');
            $table->date('dateNaissance');
            $table->string('nationaliteNaissance');
            $table->string('phone');
            $table->string('mail');
            $table->string('uid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gerant_forms');
    }
};
