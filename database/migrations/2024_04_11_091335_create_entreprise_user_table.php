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
        Schema::create('entreprise_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained('entreprises');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });


        // Move existing entreprise_id to entreprise_user
        DB::table('users')->select('id', 'entreprise_id')->orderBy('id')->each(function ($user) {
            if ($user->entreprise_id) {
                DB::table('entreprise_user')->insert([
                    'entreprise_id' => $user->entreprise_id,
                    'user_id' => $user->id,
                    'is_admin' => true,
                    'is_active' => true,
                    'date_debut' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        // Drop entreprise_id from users
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['entreprise_id']);
            $table->dropColumn('entreprise_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('entreprise_id')->constrained('entreprises');
        });

        // Move entreprise_id from entreprise_user to users
        DB::table('entreprise_user')->select('user_id', 'entreprise_id')->each(function ($entrepriseUser) {
            DB::table('users')->where('id', $entrepriseUser->user_id)->update([
                'entreprise_id' => $entrepriseUser->entreprise_id,
            ]);
        });

        Schema::dropIfExists('entreprise_user');
    }
};
