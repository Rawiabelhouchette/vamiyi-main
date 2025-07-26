<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;
class AnnonceReference extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'annonce_id',
        'reference_valeur_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->titre);
        });
    }

    protected $casts = [
        'titre' => PurifyHtmlOnGet::class,
        'slug' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'reference_valeur_id' => PurifyHtmlOnGet::class,
    ];

}
