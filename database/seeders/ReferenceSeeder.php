<?php

namespace Database\Seeders;

use App\Models\Reference;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Commodités hébergement',
            'slug_type' => 'hebergement',
            'slug_nom' => 'commodites-hebergement',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Services',
            'slug_type' => 'hebergement',
            'slug_nom' => 'services',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Types de lit',
            'slug_type' => 'hebergement',
            'slug_nom' => 'types-de-lit',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement hébergement
        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Equipements hébergement',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-hebergement',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Service
        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Services',
            'slug_type' => 'hebergement',
            'slug_nom' => 'services',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement Salle de bain
        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Equipements salle de bain',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-salle-de-bain',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement cuisine
        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Equipements cuisine',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-cuisine',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Type hebergement
        Reference::updateOrCreate([
            'type' => 'Hébergement',
            'nom' => 'Types hebergement',
            'slug_type' => 'hebergement',
            'slug_nom' => 'types-hebergement',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement véhicule
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Types de véhicule',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'types-de-vehicule',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement véhicule
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Equipements véhicule',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'equipements-vehicule',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Carte de consommation
        Reference::updateOrCreate([
            'type' => 'Restauration',
            'nom' => 'Carte de consommation',
            'slug_type' => 'restauration',
            'slug_nom' => 'carte-de-consommation',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Boite de vitesse
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Boite de vitesses',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'boite-de-vitesses',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Conditions de location
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Conditions de location',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'conditions-de-location',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Marque de véhicule
        Reference::updateOrCreate([
            'type' => 'Marque',
            'nom' => 'Marques de véhicule',
            'slug_type' => 'marque',
            'slug_nom' => 'marques-de-vehicule',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement restauration
        Reference::updateOrCreate([
            'type' => 'Restauration',
            'nom' => 'Equipements restauration',
            'slug_type' => 'restauration',
            'slug_nom' => 'equipements-restauration',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement patisserie
        Reference::updateOrCreate([
            'type' => 'Restauration',
            'nom' => 'Equipements patisserie',
            'slug_type' => 'restauration',
            'slug_nom' => 'equipements-patisserie',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Produits restauration
        Reference::updateOrCreate([
            'type' => 'Restauration',
            'nom' => 'Produits fast-food',
            'slug_type' => 'restauration',
            'slug_nom' => 'produits-fast-food',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Produits patissier
        Reference::updateOrCreate([
            'type' => 'Restauration',
            'nom' => 'Produits patissiers',
            'slug_type' => 'restauration',
            'slug_nom' => 'produits-patissiers',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);


        // Type de carburant
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Types de carburant',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'types-de-carburant',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Musique
        Reference::updateOrCreate([
            'type' => 'Vie nocturne',
            'nom' => 'Types de musique',
            'slug_type' => 'vie-nocturne',
            'slug_nom' => 'types-de-musique',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Commodite vie nocturne
        Reference::updateOrCreate([
            'type' => 'Vie nocturne',
            'nom' => 'Commodités vie nocturne',
            'slug_type' => 'vie-nocturne',
            'slug_nom' => 'commodites-vie-nocturne',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement vie nocturne
        Reference::updateOrCreate([
            'type' => 'Vie nocturne',
            'nom' => 'Equipements vie nocturne',
            'slug_type' => 'vie-nocturne',
            'slug_nom' => 'equipements-vie-nocturne',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Specialite
        Reference::updateOrCreate([
            'type' => 'Restauration',
            'nom' => 'Spécialités',
            'slug_type' => 'restauration',
            'slug_nom' => 'specialites',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);


    }
}
