<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsistenciaEvento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'asistencia_eventos';

    protected $fillable = [
        'fecha',
        'observacion',
        'persona_id',
        'ambiente_evento_id',
    ];
}
