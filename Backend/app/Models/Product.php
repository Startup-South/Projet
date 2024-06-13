<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productname', // Assurez-vous que le nom de la colonne correspond à celui utilisé dans le contrôleur
        'image',
        'price',
        'description',
        'quantity',
        'weight',
        'size',
        'is_available',
        'is_available',
        
    ];
}
