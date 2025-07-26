<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'annonce_id',
        'note',
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
