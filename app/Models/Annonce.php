<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;


class Annonce extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $fillable = [
        'titre',
        'description',
        'slug',
        'entreprise_id',
        'is_active',
        'date_validite',
        'annonceable_type',
        'annonceable_id',
        'type',
        'image',
    ];

    protected $appends = [
        'jour_restant',
        'description_courte',
        'note',
        'est_favoris',

        'view_count',
        'favorite_count',
        'comment_count',
        'notation_count',
    ];

    protected $casts = [
        'titre' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'entreprise_id' => PurifyHtmlOnGet::class,
        'date_validite' => PurifyHtmlOnGet::class,
        'type' => PurifyHtmlOnGet::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->titre);
            $model->is_active = true;
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->titre);
        });
    }


    /* ######################## RELATIONS ##############################
    ###################################################################### */

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function galerie(): BelongsToMany
    {
        return $this->belongsToMany(Fichier::class, 'annonce_fichier', 'annonce_id', 'fichier_id');
    }

    public function imagePrincipale(): BelongsTo
    {
        return $this->belongsTo(Fichier::class, 'image');
    }

    public function annonceable(): MorphTo
    {
        return $this->morphTo();
    }

    // Retrieve specific reference value
    public function references($slug = null)
    {
        if (is_null($slug)) {
            return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->withPivot('slug', 'titre');
        }
        return $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->where('slug', $slug)->get();
    }

    public function removeReferences($slug)
    {
        $this->belongsToMany(ReferenceValeur::class, 'annonce_reference_valeur', 'annonce_id', 'reference_valeur_id')->wherePivot('slug', $slug)->detach();
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function notation()
    {
        return $this->hasMany(Notation::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }


    /* ########################## METHODS ##############################
    ###################################################################### */

    // Retrieve all reference value as array
    public function referenceDisplay(): array
    {
        $references = $this->references()->get();
        $display = [];
        foreach ($references as $reference) {
            if (!array_key_exists($reference->pivot->titre, $display)) {
                $display[$reference->pivot->titre] = [];
            }
            $display[$reference->pivot->titre][] = $reference->valeur;
        }
        return $display;
    }

    public function removeGalerie(array $image_ids = null)
    {
        // $this->galerie()->detach();
        $this->galerie()->detach($image_ids);


    }

    // permettre de mettre des nombres en format 1k, 1M
    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k';
        } else {
            return $number;
        }
    }


    /* ###################### ATTRIBUTES (APPENDED) ######################
    ###################################################################### */
    public function getJourRestantAttribute(): int
    {
        $date = $this->date_validite;
        $now = date('Y-m-d');
        $diff = strtotime($date) - strtotime($now);
        return round($diff / 86400) + 1;
    }

    // description courte de l'annonce en 70 caractères
    public function getDescriptionCourteAttribute(): string
    {
        if (!$this->description) {
            return 'Pas de description';
        }

        $description = $this->description;
        $description = strip_tags($description);
        $description = str_replace('&nbsp;', ' ', $description);
        $description = str_replace("\n", ' ', $description);
        $description = str_replace("\r", ' ', $description);
        $description = str_replace("\t", ' ', $description);
        $description = str_replace('  ', ' ', $description);
        $description = substr($description, 0, 70);

        if (Str::length($description) >= 70) {
            $description = $description . '...';
        }

        return $description;
    }

    // moyen de notation de l'annonce
    public function getNoteAttribute()
    {
        // $avg = $this->notation()->avg('note');
        $avg = $this->commentaires()->avg('note');
        return number_format($avg, 1);

        // // si la moyenne est null, on retourne 0
        // if (is_null($avg)) {
        //     return number_format(0, 1);
        // }

        // // arrondir à l'entier supérieur si la décimale est supérieur ou égale à 0.5
        // $decimal = $avg - floor($avg);
        // if ($decimal >= 0 && $decimal < 0.5) {
        //     return number_format(floor($avg), 1);
        // } else {
        //     return number_format(ceil($avg), 1);
        // }
    }

    public function getEstFavorisAttribute(): bool
    {
        if (!auth()->check())
            return false;
        return $this->favoris()->where('user_id', auth()->user()->id)->exists();
    }

    public function getViewCountAttribute(): int
    {
        return $this->views()->count();
    }

    public function getFavoriteCountAttribute(): int
    {
        return $this->favoris()->count();
    }

    public function getCommentCountAttribute(): int
    {
        return $this->commentaires()->count();
    }

    public function getNotationCountAttribute(): int
    {
        return $this->notation()->count();
    }


    /* ######################## SCOPE ##############################
    ###################################################################### */
    public function scopePublic(Builder $query): void
    {
        $query
            // add some code here to make sure to only display annonce that are registrer ed to an offer
            ->whereIsActive(true)
            // check if entreprise has a valid subscription
            ->whereHas('entreprise', function ($query) {
                $query->whereHas('abonnements', function ($query) {
                    $query->where('is_active', true)
                        ->whereDate('date_fin', '>=', date('Y-m-d') . ' 23:59:59');
                });
            })
            // check if the annonce is still valid
            ->whereDate('date_validite', '>=', date('Y-m-d'));
    }

    // public function scopeAll(Builder $query): void
    // {
    //     $query->
    // }
}
