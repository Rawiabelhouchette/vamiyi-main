<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = ['annonce_id', 'user_id', 'ip_address'];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createView($annonce_id, $ip_address)
    {
        $hashed_ip_address = hash('sha256', $ip_address);

        $existingView = View::where('annonce_id', $annonce_id)
            ->where('ip_address', $hashed_ip_address)
            ->where('created_at', '>=', now()->subHours(1))
            ->first();

        if (!$existingView) {
            View::create([
                'annonce_id' => $annonce_id,
                'user_id' => auth()->id(),
                'ip_address' => $hashed_ip_address,
            ]);
        }
    }
}
