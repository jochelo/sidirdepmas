<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'eventos';

    protected $fillable = [
        'lugar',
        'fecha_inicial',
        'fecha_final',
        'tipo',
        'nombre',
        'descripcion',
        'observacion',
        'activo',
        'archivo_adjunto',
        'ubicacion_id',
    ];
}
