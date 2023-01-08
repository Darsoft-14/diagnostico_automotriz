<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toma_servicio extends Model
{
    use HasFactory;
    protected $fillable = ['num_servicio','fecha','placa','estado'];
}
