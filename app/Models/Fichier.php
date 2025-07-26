<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;

class Fichier extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'chemin',
        'extension',
    ];

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'chemin' => PurifyHtmlOnGet::class,
        'extension' => PurifyHtmlOnGet::class,
    ];
}
