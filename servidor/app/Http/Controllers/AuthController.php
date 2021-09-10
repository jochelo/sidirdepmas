<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmMessage;
use App\Mail\RegisterMessage;
use App\Models\Autorizado;
use App\Models\Estado;
use App\Models\EventoCongresoParticipante;
use App\Models\Militancia;
use App\Models\Persona;
use App\Models\PersonaCircunscripcion;
use App\Models\PersonaEvento;
use App\Models\PersonaUsuario;
use App\Models\RolPermiso;
use App\Models\SocialProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    public function login()
    {
        $request = \request()->all();
        if (Auth::attempt([
            'cuenta' => $request['cuenta'],
            'password' => $request['password']
        ])) {
            $usuario = Auth::user();
            $success['usuario'] = $usuario;
            $success['token'] = $usuario->createToken('DirDepMas')->accessToken;
            return response()->json($success, 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function loginSocial()
    {
        $data = \request()->input('usuario');
        if (isset($data['email'])) {
            $newUser = User::where('email', $data['email'])->first();
            /*if (!isset($newUser)) {
                $lastName = explode(' ', $data['lastName']);
                $persona = [
                    'nombres' => $data['firstName'],
                    'apellido_paterno' => sizeof($lastName) > 0 ? $lastName[0] : null,
                    'apellido_materno' => sizeof($lastName) > 1 ? $lastName[1] : null,
                    'email' => $data['email'],
                ];

                $user = [
                    'email' => $data['email'],
                    //'foto' => $data['foto'],
                    'rol_id' => 2,
                    'confirmed' => true
                ];
                $newPersona = Persona::create($persona);
                $newUser = User::create($user);

                PersonaUsuario::create([
                    'persona_id' => $newPersona['id'],
                    'usuario_id' => $newUser['id']
                ]);
                SocialProfile::create([
                    'social_id' => $data['id'],
                    'social_name' => $data['provider'],
                    'avatar' => $data['photoUrl'],
                    'usuario_id' => $newUser['id']
                ]);
            }*/
            if (isset($newUser)) {
                Auth::login($newUser);
                $usuario = Auth::user();
                $success['usuario'] = $usuario;
                $success['token'] = $usuario->createToken('DirDepMas')->accessToken;
                return response()->json($success, 200);
            } else {
                return response()->json(['error' => 'Este correo no esta registrado, por favor registrese antes'], 401);
            }
        } else {
            return response()->json(['error' => 'No tiene un correo registrado en esta opción'], 401);
        }
    }

    public function logout() {
        $usuario = Auth::user();
        $nombreUser = $usuario['nombre_usuario'];
        $tokenId = $usuario->token()->getKey();

        $token = app(TokenRepository::class);
        $token->revokeAccessToken($tokenId);

        return response()->json(['success' => $nombreUser . ' finalizó sesión'], 200);
    }

    public function checkUniqueEmailUsuario()
    {
        $email = \request()->input('email');
        $existe = User::where('email', $email)->exists();
        return response()->json(!$existe, 200);
    }

    public function checkUniqueCuentaUsuario()
    {
        $cuenta = \request()->input('cuenta');
        $existe = User::where('cuenta', $cuenta)->exists();
        return response()->json(!$existe, 200);
    }

    public function register()
    {
        $data = \request()->all();
        $base = $data['base'];
        $data['extension_carnet'] = $data['extension_carnet'] !== 'null' ? $data['extension_carnet'] : null;

        $existe = Persona::where('carnet', $data['carnet'])
            ->where('expedicion_carnet', $data['expedicion_carnet'])
            ->where('extension_carnet', $data['extension_carnet'])
            ->exists();
        if (!$existe) {
            $ext = $data['extension_carnet'] !== null ? $data['extension_carnet'] : '';
            if (request()->hasFile('imgcian')) {
                $path = request()->file('imgcian')->hashName('personas/' . $data['carnet'] . $data['expedicion_carnet'] . $ext);
                $image = Image::make(request()->file('imgcian'))->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::put($path, (string)$image->encode());
                $data['imgcian'] = $path;
            }

            if (request()->hasFile('imgcirev')) {
                $path = request()->file('imgcirev')->hashName('personas/' . $data['carnet'] . $data['expedicion_carnet'] . $ext);
                $image = Image::make(request()->file('imgcirev'))->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::put($path, 'ci_rev_' . Carbon::now()->format('Ymd') . (string)$image->encode());
                $data['imgcirev'] = $path;
            }

            $persona = [
                'nombres' => $data['nombres'],
                'apellido_paterno' => $data['apellido_paterno'],
                'apellido_materno' => $data['apellido_materno'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'carnet' => $data['carnet'],
                'sexo' => $data['sexo'],
                'extension_carnet' => $data['extension_carnet'],
                'expedicion_carnet' => $data['expedicion_carnet'],
                'email' => $data['email'],
                'imgcian' => $data['imgcian'],
                'imgcirev' => $data['imgcirev'],
            ];

            if (request()->hasFile('foto')) {
                $path = request()->file('foto')->hashName('usuarios/' . $data['cuenta']);
                $image = Image::make(request()->file('foto'))->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::put($path, (string)$image->encode());
                $data['foto'] = $path;
            }

            $data['foto'] = $data['foto'] !== 'null' ? $data['foto'] : null;

            $data['confirmation_code'] = Str::random(25);

            $user = [
                'email' => $data['email'],
                'cuenta' => $data['cuenta'],
                'password' => bcrypt($data['password']),
                'foto' => $data['foto'],
                'rol_id' => 2,
                'confirmation_code' => $data['confirmation_code']
            ];
            $newPersona = Persona::create($persona);
            $newUser = User::create($user);
            PersonaUsuario::create([
                'persona_id' => $newPersona['id'],
                'usuario_id' => $newUser['id']
            ]);

            // CIRCUNSCRIPCION
            PersonaCircunscripcion::create([
                'direccion' => $data['direccion'] === 'null' ? null : $data['direccion'],
                'persona_id' => $newPersona['id'],
                'circunscripcion_id' => $data['circunscripcion_id'],
                'localidad_id' => $data['localidad_id']
            ]);

            // ESTADO
            Estado::create([
               'tipo' => 'registrado',
               'persona_id' => (int) $newPersona['id']
            ]);



            //ADD TO EVENTO
            $agregado = $this->verificarCupoEvento($data['circunscripcion_id'], 1, $newPersona['id']);

            //MILITANCIA
            Militancia::create([
                'anio_militancia' => $data['gestion_militancia'],
                'persona_id'  => $newPersona['id']
            ]);

            $existCarnet = Autorizado::where('carnet', $newPersona['carnet'])
                ->where('expedicion_carnet', $newPersona['expedicion_carnet'])
                ->where('extension_carnet', $newPersona['extension_carnet'])
                ->exists();
            if ($existCarnet) {
                try {
                    Mail::to($data['email'])->send(new ConfirmMessage($newUser, $base));
                } catch (\Throwable $exception) {
                    return response()->json(['message' => 'Registrado exitosamente, Por favor valide su correo electronico', 'usuario' => $newUser, 'error' => true, 'agregado' => $agregado], 200);
                }
            } else {
                try {
                    Mail::to($data['email'])->send(new RegisterMessage($newUser));
                } catch (\Throwable $exception) {
                    return response()->json(['message' => 'Registrado exitosamente, Por favor espere que validemos su registro', 'usuario' => $newUser, 'error' => true, 'agregado' => $agregado], 200);
                }
            }
            return response()->json(['message' => 'Registrado exitosamente, Por favor valide su correo electronico', 'usuario' => $newUser, 'agregado' => $agregado], 200);
        } else {
            return response()->json(['error' => 'El Carnet de identidad ya se encuentra registrado'], 400);
        }
    }

    protected function verificarCupoEvento($idCir, $idEvento, $idpersona) {
        $nroParticipantes = EventoCongresoParticipante::where('circunscripcion_id', $idCir)
            ->where('evento_id', $idEvento)
            ->first();

        $persona = Persona::find($idpersona);

        if ($persona['sexo'] === 'masculino') {

            $nroParticipantesVaronesInscritos = PersonaEvento::where('evento_id', $idEvento)
                ->where('titular', true)
                ->count();

            if ($nroParticipantesVaronesInscritos < $nroParticipantes['cupo_varon']) {
                PersonaEvento::create([
                    'persona_id' => $persona['id'],
                    'titular' => 1,
                    'evento_id' => $idEvento,
                ]);
                return true;
            } else {
                $nroParticipantesVaronesAdscritos = PersonaEvento::where('evento_id', $idEvento)
                    ->where('titular', false)
                    ->count();
                if ($nroParticipantesVaronesAdscritos < $nroParticipantes['cupo_adscritos_varon']) {
                    PersonaEvento::create([
                        'persona_id' => $persona['id'],
                        'titular' => 0,
                        'evento_id' => $idEvento,
                    ]);
                    return true;
                } else {
                    // no es agregado
                    return false;
                }
            }
        }

        if ($persona['sexo'] === 'femenino') {
            $nroParticipantesMujeresInscritos = PersonaEvento::where('evento_id', $idEvento)
                ->where('titular', true)
                ->count();

            if ($nroParticipantesMujeresInscritos < $nroParticipantes['cupo_mujer']) {
                PersonaEvento::create([
                    'persona_id' => $persona['id'],
                    'titular' => 1,
                    'evento_id' => $idEvento,
                ]);
                return true;
            } else {
                $nroParticipantesMujeresAdscritos = PersonaEvento::where('evento_id', $idEvento)
                    ->where('titular', false)
                    ->count();
                if ($nroParticipantesMujeresAdscritos < $nroParticipantes['cupo_adscritos_mujer']) {
                    PersonaEvento::create([
                        'persona_id' => $persona['id'],
                        'titular' => 0,
                        'evento_id' => $idEvento,
                    ]);
                    return true;
                } else {
                    // no es agregada
                    return false;
                }
            }
        }
        return false;
    }

    public function sendEmailConfirm()
    {
        $user = User::find(Auth::user()['id']);
        $base = \request()->input('base');
        Mail::to($user['email'])->send(new ConfirmMessage($user, $base));
    }

    public function registerVerify()
    {
        $code = \request()->input('hash');

        $user = User::where('confirmation_code', $code)->first();

        if (!isset($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        Auth::login($user);
        $usuario = Auth::user();
        $success['usuario'] = $usuario;
        $success['token'] = $usuario->createToken('DirDepMas')->accessToken;
        return response()->json($success, 200);
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }

    public function getPermisosUrlUser()
    {
        $permisos = collect(RolPermiso::where('rol_id', (int)Auth::user()->rol_id)->get());
        $permisosAlias = $permisos->pluck('url');

        $data = [
            'permisosAlias' => $permisosAlias,
        ];
        return response()->json($data, 200);
    }

    public function download($id, $filename = null)
    {
        if ($filename === null) {
            return response()->download(public_path("/img/user.png"));
        } else {
            $usuario = User::find($id);
            return response()->download(storage_path("/app/usuarios/{$usuario['cuenta']}/{$filename}"));
        }
    }
}
