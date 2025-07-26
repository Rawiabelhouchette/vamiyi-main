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
        Schema::table('annonces', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annonces', function (Blueprint $table) {
            $table->string('slug')->unique()->after('titre')->default('slug' . rand(1, 1000));

            foreach (\App\Models\Annonce::all() as $annonce) {
                $annonce->slug = \Illuminate\Support\Str::slug($annonce->titre);
                $annonce->save();
            }
        });
    }
};
