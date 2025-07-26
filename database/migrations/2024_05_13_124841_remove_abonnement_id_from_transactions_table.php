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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['abonnement_id']);
            $table->dropColumn('abonnement_id');
            $table->dropColumn('date_creation');
            $table->dropColumn('date_modification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('abonnement_id')->nullable();
            $table->foreign('abonnement_id')->nullable()->references('id')->on('abonnements');
            $table->timestamp('date_creation')->nullable();
            $table->timestamp('date_modification')->nullable();
        });
    }
};
