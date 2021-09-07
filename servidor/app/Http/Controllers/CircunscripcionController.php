<?php

namespace App\Http\Controllers;

use App\Models\Circunscripcion;
use App\Models\Localidad;
use App\Models\Municipio;
use Illuminate\Http\Request;

class CircunscripcionController extends Controller
{
    public function getCircunscripciones() {
        $circunscripciones = Circunscripcion::get();
        return response()->json($circunscripciones, 200);
    }

    public function getLocalidadesCircunscripcion($id) {
        $municipiosId = Municipio::where('circunscripcion_id', $id)->pluck('id');
        $localidades = Localidad::whereIn('municipio_id', $municipiosId)->orderBy('nombre')->get();
        return response()->json($localidades, 200);
    }
}
