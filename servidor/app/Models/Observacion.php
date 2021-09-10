<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'observacions';

    protected $fillable = [
        'descripcion',
        'subsanado',
        'persona_id'
    ];
}
