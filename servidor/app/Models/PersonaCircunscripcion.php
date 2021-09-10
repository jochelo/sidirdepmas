<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaCircunscripcion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_circunscripcions';

    protected $fillable = [
        'fecha_inicial',
        'fecha_final',
        'activo',
        'direccion',
        'persona_id',
        'circunscripcion_id',
        'localidad_id'
    ];
}
