<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'municipios';

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'provincia_id',
        'departamento_id',
        'circunscripcion_id'
    ];
}
