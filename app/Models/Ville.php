<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Support\Str;

class Ville extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'pays_id',
    ];

    // mount
    public static function boot()
    {
        parent::boot();

        static::creating(function ($ville) {
            $ville->slug = Str::slug($ville->nom);
        });

        static::updating(function ($ville) {
            $ville->slug = Str::slug($ville->nom);
        });
    }

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'nombre_annonce'
    ];


    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function quartiers()
    {
        return $this->hasMany(Quartier::class);
    }

    // nombre d'annonce liees a la ville
    public function getNombreAnnonceAttribute()
    {
        $ville = $this->nom;
        $count = Annonce::public()->whereHas('entreprise.quartier.ville', function ($query) use ($ville) {
            $query->where('nom', $ville);
        })->count();
        return $count;
    }
}
