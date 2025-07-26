<?php

namespace Database\Seeders;

use App\Models\Pays;
use App\Models\Quartier;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pays::updateOrCreate([
            'nom' => 'Togo',
            'code' => 'togo',
            'indicatif' => '+228',
            'langue' => 'Français',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Ville::updateOrCreate([
            'nom' => 'Lomé',
            'pays_id' => 1,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Quartier::updateOrCreate([
            'nom' => 'Avedji',
            'ville_id' => 1,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Quartier::updateOrCreate([
            'nom' => 'Totsi',
            'ville_id' => 1,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Quartier::updateOrCreate([
            'nom' => 'Adidogomé',
            'ville_id' => 1,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);
    }
}
