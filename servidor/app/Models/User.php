<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cuenta',
        'email',
        'password',
        'foto',
        'rol_id',
        'confirmed',
        'confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'nombre_usuario',
        'avatar',
        'autorizado'
    ];

    public function getNombreUsuarioAttribute() {
        $idpersona = PersonaUsuario::where('usuario_id', $this->getKey())->first()['persona_id'];
        return Persona::find($idpersona)['nombres'];
    }

    public function getAvatarAttribute() {
        $social = SocialProfile::where('usuario_id', $this->getKey())->first();
        if (isset($social)) {
            return $social['avatar'];
        }
        return null;
    }

    public function getAutorizadoAttribute() {
        $idpersona = PersonaUsuario::where('usuario_id', $this->getKey())->first()['persona_id'];
        if ($idpersona === null && $this->confirmed) {
            return true;
        } else {
            $persona = Persona::find($idpersona);
            return Autorizado::where('carnet', $persona['carnet'])
                ->where('expedicion_carnet', $persona['expedicion_carnet'])
                ->where('extension_carnet', $persona['extension_carnet'])
                ->exists();
        }
    }
}
