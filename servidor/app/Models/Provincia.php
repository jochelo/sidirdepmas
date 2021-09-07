<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provincia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'provincias';

    protected $fillable = [
        'nombre',
        'departamento_id'
    ];
}
