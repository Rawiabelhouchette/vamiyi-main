<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Support\Str;

class Quartier extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'ville_id',
    ];

    protected $appends = [
        'nombre_annonce'
    ];

    // mount
    public static function boot()
    {
        parent::boot();

        static::creating(function ($quartier) {
            $quartier->slug = Str::slug($quartier->nom);
        });

        static::updating(function ($quartier) {
            $quartier->slug = Str::slug($quartier->nom);
        });
    }

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'ville_id' => PurifyHtmlOnGet::class,
    ];


    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    // All quartiers with their ville and their pays ex : "Avedji, Lome, Togo"
    // return array of string
    public static function getAllQuartiers() : array
    {
        $quartiers = Quartier::with('ville.pays')->get();
        $quartiersArray = [];
        foreach ($quartiers as $quartier) {
            $quartiersArray[] = $quartier->nom . ', ' . $quartier->ville->nom . ', ' . $quartier->ville->pays->nom;
        }
        return $quartiersArray;
    }

    public function getNombreAnnonceAttribute()
    {
        $ville = $this->nom;
        $count = Annonce::public()->whereHas('entreprise.quartier', function ($query) use ($ville) {
            $query->where('nom', $ville);
        })->count();
        return $count;
    }

    
}
