<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class Reference extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'type',
        'nom',
        'slug_type',
        'slug_nom',

        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug_type = Str::slug($model->type);
            $model->slug_nom = Str::slug($model->nom);
        });
    }

    protected $casts = [
        'type' => PurifyHtmlOnGet::class,
        'nom' => PurifyHtmlOnGet::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
