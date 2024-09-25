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
        Schema::create('upload_files', function (Blueprint $table) {
            $table->id();
            $table->string('uid'); // Store the UID
            $table->string('cniRecto'); // Store the path for CNI Recto
            $table->string('cniVerso'); // Store the path for CNI Verso
            $table->string('cniSupplementaire')->nullable(); // Store CNI Supplementaire (optional)
            $table->string('justifcatifDomicile'); // Store Justificatif Domicile path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_files');
    }
};
