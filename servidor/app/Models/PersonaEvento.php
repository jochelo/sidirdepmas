<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaEvento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_eventos';

    protected $fillable = [
        'observacion',
        'cargo',
        'titular',
        'persona_id',
        'evento_id',
    ];
}
