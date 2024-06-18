<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
        'CommandDate',
        'PaymentStatus',
        'CommandStatus',
        'DeliveryMode',
        'Comment',
        'ClientId',
        'ProductId',
        'BillId',
        'Article',
    ];

    // Définir les relations avec les autres modèles
    public function client()
    {
        return $this->belongsTo(Client::class, 'ClientId');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'BillId');
    }
}
