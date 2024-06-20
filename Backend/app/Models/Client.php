<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ClientController;


class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    // Indiquer le type de la clé primaire
        protected $keyType = 'int';

     // Définir le nom de la clé primaire
    protected $primaryKey = 'Id';

    // Indique si les IDs sont auto-incrementés
    public $incrementing = true;

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
