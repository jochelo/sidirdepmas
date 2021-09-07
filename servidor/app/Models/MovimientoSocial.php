<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoSocial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'movimiento_socials';

    protected $fillable = [
        'razon_social',
        'descripcion',
        'observacion',
        'estado',
    ];
}
