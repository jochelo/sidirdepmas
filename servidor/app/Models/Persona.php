<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'personas';

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'sexo',
        'carnet',
        'extension_carnet',
        'expedicion_carnet',
        'email',
        'imgcian',
        'imgcirev'
    ];

    protected $appends = [
        'nombre_completo',
        'anio_militancia',
        'estado',
        'foto_filename',
        'circunscripcion_codigo'
    ];
    public function getNombreCompletoAttribute() {
        return "{$this->apellido_paterno} {$this->apellido_materno} {$this->nombres}";
    }

    public function getAnioMilitanciaAttribute() {
        $anioMilitancia = Militancia::where('persona_id', $this->getKey())->orderBy('id', 'desc')->first()['anio_militancia'];
        return $anioMilitancia;
    }

    public function getEstadoAttribute() {
        $estado = Estado::where('persona_id', $this->getKey())->orderBy('id', 'desc')->first()['tipo'];
        return $estado;
    }

    public function getFotoFilenameAttribute() {
        $idUsuario = PersonaUsuario::where('persona_id', $this->getKey())->first()['usuario_id'];
        $userFoto = User::find($idUsuario)['foto'];
        if (isset($userFoto)) {
            return explode('/', $userFoto)[2];
        } else {
            return null;
        }
    }

    public function getCircunscripcionCodigoAttribute() {
        $circunscripcion = PersonaCircunscripcion::where('persona_id', $this->getKey())->where('activo', true)->first();
        $codigo = Circunscripcion::find($circunscripcion['circunscripcion_id'])['codigo'];
        return $codigo;
    }
}
