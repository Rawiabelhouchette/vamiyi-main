<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Support\Str;


class Usager extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'users';
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'username',
        'telephone',
        'password',
        'is_active',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

        'nom' => PurifyHtmlOnGet::class,
        'prenom' => PurifyHtmlOnGet::class,
        'email' => PurifyHtmlOnGet::class,
        'username' => PurifyHtmlOnGet::class,
        'telephone' => PurifyHtmlOnGet::class,
        'is_active' => PurifyHtmlOnGet::class,
    ];

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function notation()
    {
        return $this->hasMany(Notation::class);
    }
}
