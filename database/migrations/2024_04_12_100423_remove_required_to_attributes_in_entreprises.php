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
        Schema::table('entreprises', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->unsignedBigInteger('quartier_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprise', function (Blueprint $table) {
            $table->string('email')->nullable(true)->change();
            $table->unsignedBigInteger('quartier_id')->change();
        });
    }
};
