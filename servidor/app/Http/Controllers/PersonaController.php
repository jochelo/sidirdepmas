<?php

namespace App\Http\Controllers;

use App\Models\Autorizado;
use App\Models\Estado;
use App\Models\Evento;
use App\Models\EventoCongresoParticipante;
use App\Models\Observacion;
use App\Models\Persona;
use App\Models\PersonaCircunscripcion;
use App\Models\PersonaEvento;
use App\Models\PersonaUsuario;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class PersonaController extends Controller
{
    public function paginatePersonas()
    {
        $data = \request()->all();
        $datos = $data['data'];
        $idpersonas = PersonaEvento::where('evento_id', $data['data']['evento_id'])->pluck('id');
        $personas = collect(Persona::whereIn('id', $idpersonas)->where('carnet', 'like', "%{$datos['carnet']}%")->orderBy('apellido_paterno')->get());

        if ($datos['idcircunscripcion'] !== null) {
            $idpersonasCircunscripcion = PersonaCircunscripcion::where('circunscripcion_id', $datos['idcircunscripcion'])->where('activo', true)->pluck('persona_id');
            $personas = $personas->whereIn('id', $idpersonasCircunscripcion);
        }

        if ($datos['nombre'] !== null) {
            $nombre = $datos['nombre'];

            $personas = $personas->filter(function ($item) use ($nombre) {
                return preg_match("/{$nombre}/i", $item['nombre_completo']);
            });
            // $personas = $personas->where('nombre_completo', 'like', "%{$datos['nombre']}%");
        }

        if ($datos['estado'] !== null) {
            $personas = $personas->where('estado', $datos['estado']);
        }

        return response()->json($this->paginateCollect($personas, $data['items'], $data['page'], ['path' => Paginator::resolveCurrentPath()]), 200);
    }

    public function paginateCollect($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, $options);
    }

    public function storePersona()
    {
        $data = \request()->all();
        $existe = Persona::where('carnet', $data['carnet'])
            ->where('expedicion_carnet', $data['expedicion_carnet'])
            ->where('extension_carnet', $data['extension_carnet'])
            ->exists();
        if (!$existe) {
            $persona = [
                'nombres' => $data['nombres'],
                'apellido_paterno' => $data['apellido_paterno'],
                'apellido_materno' => $data['apellido_materno'],
                'sexo' => $data['sexo'],
                'carnet' => $data['carnet'],
                'extension_carnet' => $data['extension_carnet'],
                'expedicion_carnet' => $data['expedicion_carnet'],
            ];

            $user = [
                'cuenta' => explode(' ', $data['nombres'])[0],
                'password' => bcrypt($data['carnet']),
                'rol_id' => 2,
                'confirmed' => 1,
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
                'persona_id' => (int)$newPersona['id']
            ]);

            //ADD TO EVENTO
            if (isset($data['evento_id'])) {
                $agregado = $this->verificarCupoEvento($data['circunscripcion_id'], $data['evento_id'], $newPersona['id']);
                return response()->json(['persona' => $newPersona, 'agregado' => $agregado], 201);
            }

            return response()->json(['persona' => $newPersona], 201);
        } else {
            return response()->json(['error' => 'El Carnet de identidad ya se encuentra registrado'], 400);
        }
    }

    protected function verificarCupoEvento($idCir, $idEvento, $idpersona)
    {
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

    public function storeObservacionPersona($id, $idevento)
    {
        Observacion::create([
            'descripcion' => \request()->input('observacion'),
            'persona_id' => $id
        ]);
        $estado = Estado::where('persona_id', $id)->orderBy('id', 'desc')->first();

        if (isset($estado) && $estado['tipo'] !== 'observado') {
            Estado::create([
                'tipo' => 'observado',
                'persona_id' => (int)$id
            ]);
        }
        return response()->json($this->show($id, $idevento), 200);

    }

    protected function show($id, $idevento)
    {
        $persona = Persona::find($id);
        $observaciones = Observacion::where('persona_id', $id)->where('subsanado', false)->get();
        $eventoPersona = PersonaEvento::where('persona_id', $id)->where('evento_id', $idevento)->first();

        $persona['observaciones'] = $observaciones;
        $persona['cargo'] = $eventoPersona['cargo'];
        $persona['titular'] = $eventoPersona['titular'];
        $persona['observacion_evento'] = $eventoPersona['observacion'];

        return $persona;
    }

    public function showPersonaEvento($id, $idevento)
    {

        return response()->json($this->show($id, $idevento), 200);
    }

    public function showPersonaEventoInfo()
    {
        $data = request()->input('data');
        $id = $data['idpersona'];
        $idevento = $data['idevento'];
        $carnet = $data['carnet'];

        $persona = Persona::find($id);
        $observaciones = Observacion::where('persona_id', $id)->where('subsanado', false)->get();
        $eventoPersona = PersonaEvento::where('persona_id', $id)->where('evento_id', $idevento)->first();

        $persona['observaciones'] = $observaciones;
        $persona['cargo'] = $eventoPersona['cargo'];
        $persona['titular'] = $eventoPersona['titular'];
        $persona['observacion_evento'] = $eventoPersona['observacion'];

        $subcarnet = substr($persona['carnet'], strlen($persona['carnet']) - 4);

        if ($subcarnet === $carnet) {
            return response()->json($persona, 200);
        } else {
            return response()->json(['error' => 'Registro no encontrado'], 400);
        }

    }

    public function aprobarPersona($id, $idevento)
    {
        Estado::create([
            'tipo' => 'aprobado',
            'persona_id' => (int)$id
        ]);
        $persona = Persona::find($id);
        Autorizado::create([
            'carnet' => $persona['carnet'],
            'expedicion_carnet' => $persona['expedicion_carnet'],
            'extension_carnet' => $persona['extension_carnet']
        ]);
        $observaciones = Observacion::where('persona_id', $id)->where('subsanado', false)->get();
        foreach ($observaciones as $observacion) {
            $observacion['subsanado'] = true;
            $observacion->save();
        }
        $eventoPersona = PersonaEvento::where('persona_id', $id)->where('evento_id', $idevento)->first();

        $persona['cargo'] = $eventoPersona['cargo'];
        $persona['titular'] = $eventoPersona['titular'];
        $persona['observacion_evento'] = $eventoPersona['observacion'];
        $persona['observaciones'] = [];
        return response()->json($persona, 200);
    }

    public function rechazarPersona($id, $idevento)
    {
        Estado::create([
            'tipo' => 'rechazado',
            'persona_id' => (int)$id
        ]);
        return response()->json($this->show($id, $idevento), 200);
    }

    public function saveCargoPersonaEvento($id, $idevento)
    {
        $cargo = \request()->input('cargo');
        $eventoPersona = PersonaEvento::where('persona_id', $id)->where('evento_id', $idevento)->first();
        $eventoPersona['cargo'] = $cargo;
        $eventoPersona->save();
        return response()->json($this->show($id, $idevento), 200);
    }

    public function saveObservacionPersonaEvento($id, $idevento)
    {
        $observacion = \request()->input('observacion');
        $eventoPersona = PersonaEvento::where('persona_id', $id)->where('evento_id', $idevento)->first();
        $eventoPersona['observacion'] = $observacion;
        $eventoPersona->save();
        return response()->json($this->show($id, $idevento), 200);
    }

    public function saveTitularPersonaEvento($id, $idevento)
    {
        $persona = \request()->input('persona');
        $eventoPersona = PersonaEvento::where('persona_id', $id)->where('evento_id', $idevento)->first();
        $eventoPersona['titular'] = $persona['titular'];
        $eventoPersona->save();
        return response()->json($this->show($id, $idevento), 200);
    }

    public function showInscritosEvento($id)
    {
        $evento = Evento::find($id);

        $idpersonas = PersonaEvento::where('evento_id', $id)->where('titular', true)->pluck('persona_id');

        $countVarones = Persona::where('sexo', 'masculino')->whereIn('id', $idpersonas)->count();
        $countMujeres = Persona::where('sexo', 'femenino')->whereIn('id', $idpersonas)->count();

        $idpersonasAdscritos = PersonaEvento::where('evento_id', $id)->where('titular', false)->pluck('persona_id');

        $countVaronesAdscritos = Persona::where('sexo', 'masculino')->whereIn('id', $idpersonasAdscritos)->count();
        $countMujeresAdscritos = Persona::where('sexo', 'femenino')->whereIn('id', $idpersonasAdscritos)->count();

        $data = [
            'countVarones' => $countVarones,
            'countMujeres' => $countMujeres,
            'countVaronesAdscritos' => $countVaronesAdscritos,
            'countMujeresAdscritos' => $countMujeresAdscritos,
        ];

        return response()->json($data, 200);
    }

    public function download($id, $filename = null)
    {
        $idUsuario = PersonaUsuario::where('persona_id', $id)->first()['usuario_id'];
        $userFoto = User::find($idUsuario)['foto'];

        if ($userFoto === null) {
            return response()->download(public_path("/img/user.png"));
        } else {
            return response()->download(storage_path("/app/{$userFoto}"));
        }
    }

}
