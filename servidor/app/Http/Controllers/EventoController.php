<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function paginateEventos() {
        $data = \request()->all();
        $eventos = Evento::where('activo', true)->paginate($data['items']);
        return response()->json($eventos, 200);
    }

    public function getEventos() {
        $eventos = Evento::where('activo', true)->get();
        return response()->json($eventos, 200);
    }

    public function showEvento($id) {
        $evento = Evento::find($id);
        return response()->json($evento, 200);
    }
}
