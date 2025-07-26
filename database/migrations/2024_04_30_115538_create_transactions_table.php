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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('abonnement_id')->constrained();
            $table->double('montant')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('method')->nullable();
            $table->string('pay_id')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('trans_status')->nullable();
            $table->string('signature')->nullable();
            $table->string('phone')->nullable();
            $table->string('error_message')->nullable();
            $table->string('statut')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_modification')->nullable();
            $table->dateTime('date_paiement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
