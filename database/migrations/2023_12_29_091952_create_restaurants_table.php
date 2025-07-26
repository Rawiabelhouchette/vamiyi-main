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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('e_nom');
            $table->string('e_slug');
            $table->text('e_ingredients')->nullable();
            $table->integer('e_prix_min')->nullable();
            $table->integer('e_prix_max')->nullable();
            
            $table->string('p_nom');
            $table->string('p_slug');
            $table->text('p_ingredients')->nullable();
            $table->integer('p_prix_min')->nullable();
            $table->integer('p_prix_max')->nullable();
            
            $table->string('d_nom');
            $table->string('d_slug');
            $table->text('d_ingredients')->nullable();
            $table->integer('d_prix_min')->nullable();
            $table->integer('d_prix_max')->nullable();

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
        Schema::dropIfExists('restaurants');
    }
};
