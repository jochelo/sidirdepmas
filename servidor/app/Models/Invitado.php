<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitado extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_eventos';

    protected $fillable = [
        'cargo',
        'institucion',
        'persona_id',
        'evento_id',
    ];
}
