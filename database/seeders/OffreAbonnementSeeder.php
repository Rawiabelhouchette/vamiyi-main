<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffreAbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offres = [
            [
                'libelle' => 'Offre 1',
                'prix' => 150,
                'duree' => 1,
                'description' => 'Offre 1',
            ],
            [
                'libelle' => 'Offre 2',
                'prix' => 200,
                'duree' => 2,
                'description' => 'Offre 2',
            ],
            [
                'libelle' => 'Offre 3',
                'prix' => 300,
                'duree' => 3,
                'description' => 'Offre 3',
            ],
        ];

        foreach ($offres as $offre) {
            \App\Models\OffreAbonnement::create($offre);
        }
    }
}
