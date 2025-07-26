<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Annonce;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // foreach (Annonce::all() as $annonce) {
        //     $annonce->slug = Str::slug($annonce->titre);
        //     $annonce->save();
        // }

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PaysSeeder::class);
        $this->call(ReferenceSeeder::class);
        $this->call(OffreAbonnementSeeder::class);
    }
}
