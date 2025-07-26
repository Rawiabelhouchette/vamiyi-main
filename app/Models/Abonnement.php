<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'offre_abonnement_id',
        'date_debut',
        'date_fin',
        'montant',
        'is_active',
    ];

    public function entreprises()
    {
        return $this->belongsToMany(Entreprise::class, 'abonnement_entreprise');
    }

    public function entreprise($id)
    {
        return $this->entreprises()->where('entreprise_id', $id)->first();
    }

    public function offre()
    {
        return $this->belongsTo(OffreAbonnement::class, 'offre_abonnement_id');
    }
}
