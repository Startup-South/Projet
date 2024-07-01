<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ClientController;


class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'ClientFirstname', // Assurez-vous que le nom de la colonne correspond à celui utilisé dans le contrôleur
        'ClientLastname',
        'date_naissance',
        'ClientPhone',
        'codePostale',
        'adresse_facturation',
        'adresse_livraison',
        'adresse_email',
        'password',
        'genre',
        'Subscription',
        'date_inscription'
    ];
}
