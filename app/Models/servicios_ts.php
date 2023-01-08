<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicios_ts extends Model
{
    use HasFactory;
    protected $fillable = ['num_servicio','id_servicio','hora','valor','total'];
}
