<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autorizado extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'autorizados';

    protected $fillable = [
        'carnet',
        'expedicion_carnet',
        'extension_carnet'
    ];
}
