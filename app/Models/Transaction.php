<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'offre_id',
        'montant',
        'trans_id',
        'method',
        'pay_id',
        'buyer_name',
        'trans_status',
        'signature',
        'phone',
        'error_message',
        'statut',
        // 'date_creation',
        // 'date_modification',
        'date_paiement',
        'user_id',

        'entreprise',
        'numero',
        'numero_whatsapp',
    ];
}
