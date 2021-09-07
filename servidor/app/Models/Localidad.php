<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'localidads';

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'activo',
        'municipio_id',
        'provincia_id',
        'departamento_id',
    ];

    protected $appends = [
        'localidad'
    ];

    public function getLocalidadAttribute() {
        $departamento = Departamento::find($this->departamento_id)->nombre;
        $provincia = Provincia::find($this->provincia_id)->nombre;
        $municipio = Municipio::find($this->municipio_id)->nombre;
        return "{$this->nombre} {$municipio} {$provincia} {$departamento}";
    }
}
