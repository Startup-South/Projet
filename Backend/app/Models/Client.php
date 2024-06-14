<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    protected $fillable = [
        'Name', // Assurez-vous que le nom de la colonne correspond à celui utilisé dans le contrôleur

    ];
}
