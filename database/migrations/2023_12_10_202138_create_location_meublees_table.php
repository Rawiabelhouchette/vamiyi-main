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
        Schema::create('location_meublees', function (Blueprint $table) {
            $table->id();
            $table->integer('nombre_chambre');
            $table->integer('nombre_personne')->nullable();
            $table->integer('nombre_salles_bain')->nullable();
            $table->integer('superficie')->nullable();
            $table->integer('prix_min')->nullable();
            $table->integer('prix_max')->nullable();
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
        Schema::dropIfExists('location_meubles');
    }
};
