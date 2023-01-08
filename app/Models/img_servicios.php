<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class img_servicios extends Model
{
    use HasFactory;
    protected $fillable = ['servicio','url'];
}
