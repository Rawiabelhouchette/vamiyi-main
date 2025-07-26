<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAbonnement extends Model
{
    use HasFactory;

    // before save and update add slug
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = \Str::slug($model->libelle);
        });

        static::updating(function ($model) {
            $model->slug = \Str::slug($model->libelle);
        });
    }

    protected $fillable = [
        'libelle',
        'slug', // unique
        'description',
        'prix',
        'duree', // en mois
        'is_active',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    // add a scroped query
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }


    protected $appends = [
        'offres',
    ];

    public function getOffresAttribute(): array
    {
        $offres = [];
        return $offres;
    }
}
