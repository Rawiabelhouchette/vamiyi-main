<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Bar extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'type_bar',
        'type_musique',
        'capacite_accueil',
        'prix_min',
        'prix_max',
    ];

    protected $casts = [
        'type_bar' => PurifyHtmlOnGet::class,
        'type_musique' => PurifyHtmlOnGet::class,
        'capacite_accueil' => PurifyHtmlOnGet::class,
        'prix_min' => PurifyHtmlOnGet::class,
        'prix_max' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'equipements_vie_nocturne',
        'commodites_vie_nocturne',

        'caracteristiques',
    ];

    public function annonce()
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getShowUrlAttribute(): string
    {
        return route('bars.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('bars.edit', $this);
    }

    public function getEquipementsVieNocturneAttribute()
    {
        return $this->annonce->references('equipements-vie-nocturne');
    }

    public function getCommoditesVieNocturneAttribute()
    {
        return $this->annonce->references('commodites-vie-nocturne');
    }

    public function getShowInformationHeader(): View
    {
        return view('components.public.show.default-information-header');
    }

    public function getShowInformationBody(): View
    {
        return view('components.public.show.default-information-body', [
            'annonce' => $this->annonce,
        ]);
    }

    
    public function getCaracteristiquesAttribute(): array
    {
        $attributes = [];

        if ($this->type_bar) {
            $attributes['Type de bar'] = $this->type_bar;
        }

        if ($this->type_musique) {
            $attributes['Type de musique'] = $this->type_musique;
        }

        if ($this->capacite_accueil) {
            $attributes['Capacité d\'accueil'] = $this->capacite_accueil;
        }

        if ($this->prix_min) {
            $attributes['Prix minimum'] = number_format($this->prix_min, '0', ',', '.');
        }

        if ($this->prix_max) {
            $attributes['Prix maximum'] = number_format($this->prix_max, '0', ',', '.');
        }

        foreach ($attributes as $key => $value) {
            if (is_numeric($value)) {
                $attributes[$key] = number_format($value, 0, ',', ' ');
            }
        }

        return $attributes;
    }
}
