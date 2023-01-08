<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'placa',
        'linea',
        'marca',
        'modelo',
        'vin',
        'motor',
        'color',
        'tipo'
    ];
}
