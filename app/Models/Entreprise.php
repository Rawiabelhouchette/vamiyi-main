<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Str;

class Entreprise extends Model
{
    use HasFactory, softDeletes, Userstamps;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'site_web',
        'email',
        'telephone',
        'instagram',
        'facebook',
        'whatsapp',
        'logo',
        'quartier_id',
        'longitude',
        'latitude',
    ];

    // before saing and updating
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->nom);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->nom);
        });
    }

    protected $appends = [
        'nombre_annonces',
        'est_ouverte',
        'adresse_complete',
        'heure_ouvertures',
        'contact',
    ];

    public function getNombreAnnoncesAttribute()
    {
        return $this->annonces()->count();
    }

    public function getEstOuverteAttribute()
    {
        $date = new \DateTime('now', new \DateTimeZone('Africa/Lome'));
        $jour = \IntlDateFormatter::formatObject($date, 'eeee', 'fr');
        $heure = date('H:i:s');
        $heure_ouverture = $this->heure_ouverture()->where('jour', $jour)->first();
        if ($this->heure_ouverture()->where('jour', 'Tous les jours')->first()) {
            return true;
        }

        if ($heure_ouverture) {
            if ($heure >= $heure_ouverture->heure_debut && $heure <= $heure_ouverture->heure_fin) {
                return true;
            }
        }

        return false;
    }

    public function getAdresseCompleteAttribute()
    {
        $quartier = $this->quartier->nom ?? '';
        $ville = $this->quartier->ville->nom ?? '';
        $pays = $this->quartier->ville->pays->nom ?? '';
        return $pays . ', ' . $ville . ', ' . $quartier;
    }

    public function getHeureOuverturesAttribute(): array
    {
        $jours = [
            'Lundi' => 'Fermé',
            'Mardi' => 'Fermé',
            'Mercredi' => 'Fermé',
            'Jeudi' => 'Fermé',
            'Vendredi' => 'Fermé',
            'Samedi' => 'Fermé',
            'Dimanche' => 'Fermé',
        ];

        $jours_ouvertures = $this->heure_ouverture()->get();

        $tous_les_jours = $this->heure_ouverture()->where('jour', 'Tous les jours')->first();
        if ($tous_les_jours) {
            $tmp = [];
            foreach ($jours as $key => $jour) {
                $tmp[ucfirst($key)] = date('H:i', strtotime($tous_les_jours->heure_debut)) . ' - ' . date('H:i', strtotime($tous_les_jours->heure_fin));
            }
            return $tmp;
        }

        foreach ($jours_ouvertures as $jour) {
            $jours[$jour->jour] = date('H:i', strtotime($jour->heure_debut)) . ' - ' . date('H:i', strtotime($jour->heure_fin));
        }

        return $jours;
    }

    public function getContactAttribute(): string
    {
        return ($this->quartier->ville->pays->indicatif ?? '') . ' ' . str_replace(' ', '', $this->telephone);
    }

    protected $casts = [
        'nom' => PurifyHtmlOnGet::class,
        'description' => PurifyHtmlOnGet::class,
        'site_web' => PurifyHtmlOnGet::class,
        'email' => PurifyHtmlOnGet::class,
        'telephone' => PurifyHtmlOnGet::class,
        'instagram' => PurifyHtmlOnGet::class,
        'facebook' => PurifyHtmlOnGet::class,
        'whatsapp' => PurifyHtmlOnGet::class,
        'logo' => PurifyHtmlOnGet::class,
        'quartier_id' => PurifyHtmlOnGet::class,
        'longitude' => PurifyHtmlOnGet::class,
        'latitude' => PurifyHtmlOnGet::class,
    ];


    public function heure_ouverture()
    {
        return $this->hasMany(HeureOuverture::class, 'entreprise_id');
    }

    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartier_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'entreprise_id');
    }

    public function abonnements()
    {
        return $this->belongsToMany(Abonnement::class, 'abonnement_entreprise', 'entreprise_id', 'abonnement_id');
    }

    public function abonnement($id)
    {
        return $this->abonnements()->where('abonnement_id', $id)->first();
    }
}
