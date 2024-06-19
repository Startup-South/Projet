<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_name', // Correspond au nom de la colonne dans la migration
        'product_img', // Correspond au nom de la colonne dans la migration
        'product_status', // Correspond au nom de la colonne dans la migration
        'stock', // Correspond au nom de la colonne dans la migration
        'market_price', // Correspond au nom de la colonne dans la migration
        'sale_channel', // Correspond au nom de la colonne dans la migration
        'product_description', // Correspond au nom de la colonne dans la migration
        'product_type', // Correspond au nom de la colonne dans la migration
        'product_pound', // Correspond au nom de la colonne dans la migration
        'product_city_origin', // Correspond au nom de la colonne dans la migration
        'code_sh', // Correspond au nom de la colonne dans la migration
        'product_price', // Correspond au nom de la colonne dans la migration
        'product_code', // Correspond au nom de la colonne dans la migration
        'product_shop', // Correspond au nom de la colonne dans la migration
        'product_options', // Correspond au nom de la colonne dans la migration et doit être géré comme un tableau ou un objet JSON
        'product_value', // Correspond au nom de la colonne dans la migration

    ];
}
