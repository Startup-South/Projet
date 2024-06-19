<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'BillCode', // Assurez-vous que le nom de la colonne correspond à celui utilisé dans le contrôleur
        'TotalPrice',
        'Article',
        'DeliveryPrice',
        'BillProduct',
    ];
}
