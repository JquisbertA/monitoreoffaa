<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradoController extends Controller
{
    public function CrearGrado(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
    }

    public function EditarGrado(Request $request) //BASE
    {
        
    }

    public function EliminarGrado(Request $request) //BASE
    {
        
    }

    public function ListarGrado(Request $request) //BASE
    {
        $fuerza = $request->fuerza;
        
        $grado = DB::table('grado')
                ->select('id', 'id_fuerza', 'grado', 'abreviatura', 'estado')
                ->where('estado', 1)
                ->where('id_fuerza', $fuerza)
                ->orderBy('id', 'asc')
                ->get();
                return ['grado' => $grado];
    }
}
