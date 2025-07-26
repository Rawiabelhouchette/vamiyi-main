<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Wildside\Userstamps\Userstamps;

class FastFood extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $table = 'fast_foods';

    protected $fillable = [
        // 'ingredient',
        'prix_min',
        'prix_max',
    ];

    protected $casts = [
        // 'ingredient' => PurifyHtmlOnGet::class,
        'prix_min' => 'integer',
        'prix_max' => 'integer',
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'equipements_restauration',
        'produits_fast_food',

        'caracteristiques',
    ];

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getShowUrlAttribute(): string
    {
        return route('fast-foods.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('fast-foods.edit', $this);
    }

    public function getEquipementsRestaurationAttribute(): array
    {
        return $this->annonce->references('equipements-restauration')->pluck('id')->toArray();
    }

    public function getProduitsFastFoodAttribute(): array
    {
        return $this->annonce->references('produits-fast-food')->pluck('id')->toArray();
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
