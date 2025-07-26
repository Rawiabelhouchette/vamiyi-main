<?php 

namespace App\Utils;

use App\Models\Reference;

class References {

    public static function getList() {
        // liste unique des types de références
        $types = Reference::select('type')->distinct()->get()->pluck('type')->toArray();
        // return [
        //     'Location de véhicule',
        //     'Hébergement',
        //     'Entreprise',
        //     'Marque',
        //     // 'Restauration',
        //     'Vie nocturne'
        // ];
        return $types;
    }
}