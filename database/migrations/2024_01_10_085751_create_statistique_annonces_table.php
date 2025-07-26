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
        Schema::create('statistique_annonces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->constrained('annonces')->onDelete('cascade');
            $table->unsignedInteger('nb_vue')->default(0);
            $table->unsignedInteger('nb_vue_par_jour')->default(0);
            $table->unsignedInteger('nb_vue_par_semaine')->default(0);
            $table->unsignedInteger('nb_vue_par_mois')->default(0);
            $table->unsignedInteger('nb_partage')->default(0);
            $table->unsignedInteger('nb_favoris')->default(0);
            $table->unsignedInteger('nb_commentaire')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistique_annonces');
    }
};
