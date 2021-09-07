<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventoCongresoParticipante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'evento_congreso_participantes';

    protected $fillable = [
        'cupo_varon',
        'cupo_mujer',
        'equidad',
        'cupo_adscritos_varon',
        'cupo_adscritos_mujer',
        'adscritos',
        'circunscripcion_id',
        'evento_id',
    ];
}
