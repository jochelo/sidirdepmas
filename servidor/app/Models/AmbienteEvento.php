<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmbienteEvento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ambiente_eventos';

    protected $fillable = [
        'descripcion',
        'ubicacion_id',
        'evento_id',
    ];
}
