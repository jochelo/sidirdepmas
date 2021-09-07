<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaMovimientoSocial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_movimiento_socials';

    protected $fillable = [
        'estado',
        'persona_id',
        'movimiento_social_id',
    ];
}
