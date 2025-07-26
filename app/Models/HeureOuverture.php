<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;


class HeureOuverture extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'jour',
        'heure_debut',
        'heure_fin',
        'entreprise_id'
    ];

    protected $casts = [
        'jour' => PurifyHtmlOnGet::class,
        'heure_debut' => PurifyHtmlOnGet::class,
        'heure_fin' => PurifyHtmlOnGet::class,
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    
}
