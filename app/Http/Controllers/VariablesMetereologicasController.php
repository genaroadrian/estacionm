<?php

namespace App\Http\Controllers;

use App\Models\VariablesMetereologicas;
use Illuminate\Http\Request;

class VariablesMetereologicasController extends Controller
{
    public function index(Request $request) {
        $data = VariablesMetereologicas::whereBetween('fecha',[$request->inicio, $request->final])
        ->orderBy('fecha', 'ASC')->get();
        return response()->json($data, 200);
    }

    public function store(Request $request) {
        $exist = VariablesMetereologicas::Where('fecha', $request->fecha)->count();
        if($exist == 0) {
            $record = VariablesMetereologicas::create($request->all());
        }
        return response()->json(204);
    }

    public function obtenerUltimo() {
        $data = VariablesMetereologicas::orderBy('fecha', 'desc')->first();
        return response()->json($data, 200);
    }
    
}