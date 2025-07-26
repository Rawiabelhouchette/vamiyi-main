<?php

namespace App\Models;

use App\Utils\AnnonceInterface;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\View;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Support\Str;


class Restaurant extends Model implements AnnonceInterface
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'e_nom',
        'e_slug',
        'e_ingredients',
        'e_prix_min',
        'e_prix_max',

        'p_nom',
        'p_slug',
        'p_ingredients',
        'p_accompagnements',
        'p_prix_min',
        'p_prix_max',

        'd_nom',
        'd_slug',
        'd_ingredients',
        'd_prix_min',
        'd_prix_max',
    ];

    protected $appends = [
        'show_url',
        'edit_url',

        'specialites',
        'equipements_restauration',
        'carte_consommation',

        'caracteristiques',

        'entrees',
        'plats',
        'desserts',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->e_slug = Str::slug($model->e_nom);
            $model->p_slug = Str::slug($model->p_nom);
            $model->d_slug = Str::slug($model->d_nom);
        });

        static::updating(function ($model) {
            $model->e_slug = Str::slug($model->e_nom);
            $model->p_slug = Str::slug($model->p_nom);
            $model->d_slug = Str::slug($model->d_nom);
        });
    }

    protected $casts = [
        'e_nom' => PurifyHtmlOnGet::class,
        'e_ingredients' => PurifyHtmlOnGet::class,
        'e_prix_min' => PurifyHtmlOnGet::class,
        'e_prix_max' => PurifyHtmlOnGet::class,

        'p_nom' => PurifyHtmlOnGet::class,
        'p_ingredients' => PurifyHtmlOnGet::class,
        'p_prix_min' => PurifyHtmlOnGet::class,
        'p_prix_max' => PurifyHtmlOnGet::class,

        'd_nom' => PurifyHtmlOnGet::class,
        'd_ingredients' => PurifyHtmlOnGet::class,
        'd_prix_min' => PurifyHtmlOnGet::class,
        'd_prix_max' => PurifyHtmlOnGet::class,
    ];

    public function getShowUrlAttribute(): string
    {
        return route('restaurants.show', $this);
    }

    public function getEditUrlAttribute(): string
    {
        return route('restaurants.edit', $this);
    }

    public function annonce(): MorphOne
    {
        return $this->morphOne(Annonce::class, 'annonceable');
    }

    public function getSpecialitesAttribute()
    {
        return $this->annonce->references('specialites');
    }

    public function getEquipementsRestaurationAttribute()
    {
        return $this->annonce->references('equipements-restauration');
    }

    public function getCarteConsommationAttribute()
    {
        return $this->annonce->references('carte-de-consommation');
    }

    public function getShowInformationHeader(): View
    {
        return view('components.public.show.restaurant-information-header');
    }

    public function getShowInformationBody(): View
    {
        return view('components.public.show.restaurant-information-body', [
            'annonce' => $this->annonce,
        ]);
    }

    // function to transform string into array using explode
    public function getStringArray($string)
    {
        if (empty($string)) {
            return [];
        }
        $tmp = explode(Utils::getRestaurantValueSeparator(), $string);
        return array_filter($tmp, function ($value) {
            return !empty($value);
        });
    }

    public function getEntreesAttribute()
    {
        $entrees = [];

        $tmp_nom = $this->getStringArray($this->e_nom);
        $tmp_ingredients = $this->getStringArray($this->e_ingredients);
        $tmp_prix_min = $this->getStringArray($this->e_prix_min);
        $tmp_prix_max = $this->getStringArray($this->e_prix_max);

        for ($i = 0; $i < count($tmp_nom); $i++) {
            $entrees[] = [
                'nom' => $tmp_nom[$i],
                'ingredients' => $tmp_ingredients[$i],
                'prix_min' => (int) $tmp_prix_min[$i],
                'prix_max' => (int) $tmp_prix_max[$i]
            ];
        }

        return $entrees;
    }

    public function getPlatsAttribute()
    {
        $plats = [];

        $tmp_nom = $this->getStringArray($this->p_nom);
        $tmp_ingredients = $this->getStringArray($this->p_ingredients);
        $tmp_accompagnements = $this->getStringArray($this->p_accompagnements);
        $tmp_prix_min = $this->getStringArray($this->p_prix_min);
        $tmp_prix_max = $this->getStringArray($this->p_prix_max);

        for ($i = 0; $i < count($tmp_nom); $i++) {
            $plats[] = [
                'nom' => $tmp_nom[$i],
                'ingredients' => $tmp_ingredients[$i],
                'accompagnements' => $tmp_accompagnements[$i],
                'prix_min' => (int) $tmp_prix_min[$i],
                'prix_max' => (int) $tmp_prix_max[$i]
            ];
        }

        return $plats;
    }

    public function getDessertsAttribute()
    {
        $desserts = [];

        $tmp_nom = $this->getStringArray($this->d_nom);
        $tmp_ingredients = $this->getStringArray($this->d_ingredients);
        $tmp_prix_min = $this->getStringArray($this->d_prix_min);
        $tmp_prix_max = $this->getStringArray($this->d_prix_max);

        for ($i = 0; $i < count($tmp_nom); $i++) {
            $desserts[] = [
                'nom' => $tmp_nom[$i],
                'ingredients' => $tmp_ingredients[$i],
                'prix_min' => (int) $tmp_prix_min[$i],
                'prix_max' => (int) $tmp_prix_max[$i]
            ];
        }

        return $desserts;
    }

    public function getCaracteristiquesAttribute(): array
    {
        return [];
    }
}
