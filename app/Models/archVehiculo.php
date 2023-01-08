<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archVehiculo extends Model
{
    use HasFactory;
    protected $fillable = ['placa','url'];
}
