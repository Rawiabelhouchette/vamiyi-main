<?php

namespace App\Utils;

use App\Models\Fichier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class AnnoncesUtils
{
    public static function getAnnonceList(): object
    {
        return collect([
            (object) [
                'nom' => 'Auberge',
                'icon' => 'fas fa-hotel',
                'route' => 'auberges.create',
                'color' => 'info'
            ],
            (object) [
                'nom' => 'Hôtel',
                'icon' => 'fas fa-hotel',
                'route' => 'hotels.create',
                'color' => 'sucess'
            ],
            (object) [
                'nom' => 'Location de véhicule',
                'icon' => 'fas fa-car',
                'route' => 'location-vehicules.create',
                'color' => 'warning'
            ],
            (object) [
                'nom' => 'Location meublée',
                'icon' => 'fas fa-home',
                'route' => 'location-meublees.create',
                'color' => 'info'
            ],
            (object) [
                'nom' => 'Boite de nuit',
                'icon' => 'fas fa-glass-cheers',
                'route' => 'boite-de-nuits.create',
                'color' => 'danger'
            ],
            (object) [
                'nom' => 'Fast-food',
                'icon' => 'fas fa-utensils',
                'route' => 'fast-foods.create',
                'color' => 'info'
            ],
            (object) [
                'nom' => 'Restaurant',
                'icon' => 'fas fa-burger',
                'route' => 'restaurants.create',
                'color' => 'sucess'
            ],
            (object) [
                'nom' => 'Patisserie',
                'icon' => 'fas fa-birthday-cake',
                'route' => 'patisseries.create',
                'color' => 'warning'
            ],
            (object) [
                'nom' => 'Bar & Rooftop',
                'icon' => 'fas fa-glass-martini-alt',
                'route' => 'bars.create',
                'color' => 'info'
            ]
        ]);
    }

    public static function getPublicAnnonceList(): object
    {
        $img_path = 'assets_client/img/type-annonce/';
        return collect([
            (object) [
                'nom' => 'Hôtel',
                'libelle' => 'Hôtel',
                'icon' => 'fa fa-hotel',
                'route' => '',
                'color' => 'cl-success',
                'bg' => 'h',
                'image' => $img_path . 'hotel.jpg',
            ],
            (object) [
                'nom' => 'Véhicule',
                'libelle' => 'Location de véhicule',
                'icon' => 'fa fa-car',
                'route' => '',
                'color' => 'cl-warning',
                'bg' => 'v',
                'image' => $img_path . 'vehicule.jpg',
            ],
            (object) [
                'nom' => 'Auberge',
                'libelle' => 'Auberge',
                'icon' => 'fa fa-hotel',
                'route' => '',
                'color' => 'cl-info',
                'bg' => 'a',
                'image' => $img_path . 'hotel.jpg',
            ],
            (object) [
                'nom' => 'Meuble',
                'libelle' => 'Location meublée',
                'icon' => 'fa fa-home',
                'route' => '',
                'color' => 'cl-info',
                'bg' => 'm',
                'image' => $img_path . 'meuble.jpg',
            ],
            (object) [
                'nom' => 'Boite de nuit',
                'libelle' => 'Boite de nuit',
                'icon' => 'fas fa-glass-cheers',
                'route' => '',
                'color' => 'cl-danger',
                'bg' => 'b',
                'image' => $img_path . 'boite.jpg',
            ],
            (object) [
                'nom' => 'Bar',
                'libelle' => 'Bar & Rooftop',
                'icon' => 'fas fa-glass-martini-alt',
                'route' => '',
                'color' => 'cl-info',
                'bg' => 'f',
                'image' => $img_path . 'bar.jpg',
            ],
            (object) [
                'nom' => 'Restaurant',
                'libelle' => 'Restaurant',
                'icon' => 'fa fa-utensils',
                'route' => '',
                'color' => 'cl-success',
                'bg' => 'd',
                'image' => $img_path . 'restaurant.jpg',
            ],
            (object) [
                'nom' => 'Patisserie',
                'libelle' => 'Patisserie',
                'icon' => 'fa fa-birthday-cake',
                'route' => '',
                'color' => 'cl-warning',
                'bg' => 'p',
                'image' => $img_path . 'patisserie.jpg',
            ],
            (object) [
                'nom' => 'Fast-Food',
                'libelle' => 'Fast-Food',
                'icon' => 'fa fa-burger',
                'route' => '',
                'color' => 'cl-info',
                'bg' => 'f',
                'image' => $img_path . 'fast-food.jpg',
            ],
        ]);
    }

    public static function createReference($model, $variable, $title, $slug): void
    {
        if ($variable) {
            foreach ($variable as $value) {
                $model->references()->attach(
                    $value,
                    [
                        'titre' => $title,
                        'slug' => $slug,
                    ]
                );
            }
        }
    }
    public static function updateReference($model, $variable, $title, $slug): void
    {
        $model->removeReferences($slug);
        foreach ($variable as $value) {
            $model->references()->attach(
                $value,
                [
                    'titre' => $title,
                    'slug' => $slug,
                ]
            );
        }
    }

    public static function createManyReference($model, $references)
    {
        if (!$references)
            return;

        try {
            for ($i = 0; $i < count($references); $i++) {
                AnnoncesUtils::createReference($model, $references[$i][1], $references[$i][0], Str::slug($references[$i][0]));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public static function updateManyReference($model, $references)
    {
        if (!$references)
            return;

        try {
            for ($i = 0; $i < count($references); $i++) {
                AnnoncesUtils::updateReference($model, $references[$i][1], $references[$i][0], Str::slug($references[$i][0]));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public static function createGalerie($model, $image, $variable, $folder_name): void
    {
        // dump($folder_name);
        if ($image) {
            $image->store('public/' . $folder_name);
            $fichier = Fichier::create([
                'nom' => $image->hashName(),
                'chemin' => $folder_name . '/' . $image->hashName(),
                'extension' => $image->extension(),
            ]);

            $model->image = $fichier->id;
            $model->save();
        }

        if ($variable) {
            foreach ($variable as $image) {
                $image->store('public/' . $folder_name);
                $fichier = Fichier::create([
                    'nom' => $image->hashName(),
                    'chemin' => $folder_name . '/' . $image->hashName(),
                    'extension' => $image->extension(),
                ]);

                $model->galerie()->attach($fichier->id);
            }
        }
    }

    public static function updateGalerie($image, $model, $variable, $delete_galerie, $folder_name): void
    {
        if ($image) {
            $image->store('public/' . $folder_name);
            $fichier = Fichier::create([
                'nom' => $image->hashName(),
                'chemin' => $folder_name . '/' . $image->hashName(),
                'extension' => $image->extension(),
            ]);

            $model->image = $fichier->id;
            $model->save();
        }

        if ($variable || $delete_galerie) {
            $model->removeGalerie($delete_galerie);
            foreach ($variable as $image) {
                $image->store('public/' . $folder_name);
                $fichier = Fichier::create([
                    'nom' => $image->hashName(),
                    'chemin' => $folder_name . '/' . $image->hashName(),
                    'extension' => $image->extension(),
                ]);

                $model->galerie()->attach($fichier->id);
            }
        }
    }

    // function to grab all query parameters from the current url to an object
    public static function getQueryParams(): object
    {
        $query = request()->query();

        $params = [];
        foreach ($query as $key => $value) {
            if (str_starts_with($key, 'type')) {
                $key = 'type';
            }

            if (is_array($value)) {
                $params[$key] = array_map('urldecode', $value);
            } else {
                $params[$key] = urldecode($value);
            }
        }

        return (object) $params;
    }
}

