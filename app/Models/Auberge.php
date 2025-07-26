<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class Auberge extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'nombre_chambre',
        'nombre_personne',
        'superficie',
        'prix_min',
        'prix_max',
        // 'type',
        'nombre_salles_bain',
    ];

    protected $casts = [
        'nombre_chambre' => PurifyHtmlOnGet::class,
        'nombre_personne' => PurifyHtmlOnGet::class,
        'superficie' => PurifyHtmlOnGet::class,
        'prix_min' => PurifyHtmlOnGet::class,
        'prix_max' => PurifyHtmlOnGet::class,
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'types_lit',
        'commodites',
        'services',
        'equipements_hebergement',
        'equipements_salle_bain',
        'equipements_cuisine',
        'commodites',
        'types_hebergement',

        'caracteristiques',
    ];


    public function getShowUrlAttribute(): string
    {
        return route('auberges.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('auberges.edit', $this);
    }

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getTypesLitAttribute()
    {
        return $this->annonce->references('types-de-lit');
    }

    public function getCommoditesAttribute()
    {
        return $this->annonce->references('commodites-hebergement');
    }

    public function getServicesAttribute()
    {
        return $this->annonce->references('services');
    }

    public function getEquipementsHebergementAttribute()
    {
        return $this->annonce->references('equipements-hebergement');
    }

    public function getEquipementsSalleBainAttribute()
    {
        return $this->annonce->references('equipements-salle-de-bain');
    }

    public function getEquipementsCuisineAttribute()
    {
        return $this->annonce->references('equipements-cuisine');
    }

    public function getTypesHebergementAttribute()
    {
        return $this->annonce->references('types-hebergement');
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
        if ($this->nombre_chambre) {
            $attributes['Nombre de chambre'] = $this->nombre_chambre;
        }

        if ($this->nombre_personne) {
            $attributes['Nombre de personne'] = $this->nombre_personne;
        }

        if ($this->superficie) {
            $attributes['Superficie'] = $this->superficie;
        }

        if ($this->prix_min) {
            $attributes['Prix minimum'] = $this->prix_min;
        }

        if ($this->prix_max) {
            $attributes['Prix maximum'] = $this->prix_max;
        }

        foreach ($attributes as $key => $value) {
            if (is_numeric($value)) {
                $attributes[$key] = number_format($value, 0, ',', ' ');
            }
        }

        return $attributes;
    }

}
