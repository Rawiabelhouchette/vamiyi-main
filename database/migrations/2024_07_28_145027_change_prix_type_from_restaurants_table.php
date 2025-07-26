<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('e_prix_min')->change();
            $table->string('e_prix_max')->change();
            $table->string('p_prix_min')->change();
            $table->string('p_prix_max')->change();
            $table->string('d_prix_min')->change();
            $table->string('d_prix_max')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->integer('e_prix_min')->nullable()->change();
            $table->integer('e_prix_max')->nullable()->change();
            $table->integer('p_prix_min')->nullable()->change();
            $table->integer('p_prix_max')->nullable()->change();
            $table->integer('d_prix_min')->nullable()->change();
            $table->integer('d_prix_max')->nullable()->change();
        });
    }
};
