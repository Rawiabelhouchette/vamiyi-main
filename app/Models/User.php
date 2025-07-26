<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Userstamps, softDeletes, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

        'username' => PurifyHtmlOnGet::class,
        'email' => PurifyHtmlOnGet::class,
        'nom' => PurifyHtmlOnGet::class,
        'prenom' => PurifyHtmlOnGet::class,
        'telephone' => PurifyHtmlOnGet::class,
    ];

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPassword($token));
    // }


    /**
     * Get the entreprise that owns the user.
     */
    public function entreprises()
    {
        return $this
            ->belongsToMany(Entreprise::class, 'entreprise_user', 'user_id', 'entreprise_id')
            ->withPivot('is_admin', 'is_active', 'date_debut', 'date_fin')
            ->wherePivot('is_active', true)
            ->withTimestamps();
    }


    /**
     * Get the favoris annonces for the user.
     */
    public function favorisAnnonces()
    {
        return $this
            ->belongsToMany(Annonce::class, 'favoris', 'user_id', 'annonce_id')
            ->withPivot('id')
            ->latest();
    }

    /**
     * Get the commentaires for the user.
     */
    public function commentaires()
    {
        return $this
            ->belongsToMany(Annonce::class, 'commentaires', 'user_id', 'annonce_id')
            ->public()
            ->withPivot('contenu', 'created_at', 'deleted_at')
            ->wherePivotNull('deleted_at')
            ->latest();
    }

    public function annonces()
    {
        $entreprises_id = $this->entreprises->pluck('id');
        return Annonce::with('entreprise', 'annonceable')->whereIn('entreprise_id', $entreprises_id)->latest();
    }

    public function abonnements()
    {
        $entreprises_id = $this->entreprises->pluck('id');
        return Abonnement::with('offre', 'entreprises')->whereHas('entreprises', function ($query) use ($entreprises_id) {
            $query->whereIn('entreprise_id', $entreprises_id);
        })->latest();
    }

    public function activeAbonnements()
    {
        return $this->belongsToMany(Abonnement::class, 'abonnement_user', 'user_id', 'abonnement_id')
            ->withPivot('is_active', 'date_debut', 'date_fin')
            ->wherePivot('is_active', true)
            ->withTimestamps();
    }
}
