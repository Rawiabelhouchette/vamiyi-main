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
        Schema::create('location_vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele')->nullable();
            $table->string('annee')->nullable();
            $table->string('carburant')->nullable();
            $table->string('kilometrage')->nullable();
            $table->string('boite_vitesse')->nullable();
            $table->integer('nombre_portes')->nullable();
            $table->integer('nombre_places');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_vehicules');
    }
};
