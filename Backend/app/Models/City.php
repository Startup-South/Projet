<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CityController;

class City extends Model
{
  protected $table = 'cities';

  // Clé primaire du modèle
  protected $primaryKey = 'id';

  // Indique si les IDs sont auto-incrementés
  public $incrementing = true;

    use HasFactory;
    protected $fillable = ['PaysCode','PaysName','SecondName','Flag'];
}
