<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $fillable = [
        'exp_zone',
        'del_duration',
        'max_pound',
        'min_pound',
        'tarif_price',
        'deliveryId',
    ];
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'deliveryId');
    }
}
