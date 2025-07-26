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
        Schema::create('annonce_reference_valeur', function (Blueprint $table) {
            $table->string('titre');
            $table->string('slug');
            $table->foreignId('annonce_id')->constrained('annonces');
            $table->foreignId('reference_valeur_id')->constrained('reference_valeurs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonce_references');
    }
};
