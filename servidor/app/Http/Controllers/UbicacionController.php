<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function getDepartamentos() {
        $departamentos = Departamento::get();

        return response()->json($departamentos, 200);
    }
}
