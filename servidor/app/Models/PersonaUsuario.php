<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaUsuario extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'persona_usuarios';
    protected $fillable = [
        'persona_id',
        'usuario_id'
    ];
}
