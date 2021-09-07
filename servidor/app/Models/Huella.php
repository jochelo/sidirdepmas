<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Huella extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'huellas';
    protected $fillable = [
        'numero_dedo',
        'nombre_dedo',
        'codigo_huella',
        'persona_id'
    ];
}
