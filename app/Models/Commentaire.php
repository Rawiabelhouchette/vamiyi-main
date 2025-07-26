<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentaire extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'note',
        'contenu',
        'user_id',
        'parent_id',
        'annonce_id',
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function parent()
    {
        return $this->belongsTo(Commentaire::class, 'parent_id');
    }

    public function reponses()
    {
        return $this->hasMany(Commentaire::class, 'parent_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
