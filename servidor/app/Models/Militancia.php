<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Militancia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'militancias';

    protected $fillable = [
      'anio_militancia',
      'persona_id'
    ];
}
