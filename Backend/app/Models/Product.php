<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_img',
        'product_status',
        'stock',
        'market_price',
        'sale_channel',
        'product_description',
        'product_type',
        'product_pound',
        'product_city_origin',
        'code_sh',
        'product_price',
        'product_code',
        'product_shop',
        'product_options',
        'product_value',
    ];
}
