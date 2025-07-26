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

class BoiteDeNuit extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [];

    protected $casts = [];

    protected $appends = [
        'show_url',
        'edit_url',

        'commodites',
        'services',
        'types_musique',
        'equipements_vie_nocturne',

        'caracteristiques',
    ];

    public function getShowUrlAttribute(): string
    {
        return route('boite-de-nuits.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('boite-de-nuits.edit', $this);
    }

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getCommoditesAttribute()
    {
        return $this->annonce->references('commodites-hebergement');
    }

    public function getServicesAttribute()
    {
        return $this->annonce->references('services');
    }

    public function getTypesMusiqueAttribute()
    {
        return $this->annonce->references('types-de-musique');
    }

    public function getEquipementsVieNocturneAttribute()
    {
        return $this->annonce->references('equipements-vie-nocturne');
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

        foreach ($attributes as $key => $value) {
            if (is_numeric($value)) {
                $attributes[$key] = number_format($value, 0, ',', ' ');
            }
        }

        return $attributes;
    }

}
