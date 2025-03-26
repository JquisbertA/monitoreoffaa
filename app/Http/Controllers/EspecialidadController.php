<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspecialidadController extends Controller
{
    public function CrearEspecialidad(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
    }

    public function EditarEspecialidad(Request $request) //BASE
    {
        
    }

    public function EliminarEspecialidad(Request $request) //BASE
    {
        
    }

    public function ListarEspecialidad(Request $request) //BASE
    {
        $fuerza = $request->fuerza;
        
        $especialidad = DB::table('especialidad')
                ->select('id', 'id_fuerza', 'especialidad', 'abreviatura', 'estado')
                ->where('estado', 1)
                ->where('id_fuerza', $fuerza)
                ->orderBy('id', 'asc')
                ->get();
                return ['especialidad' => $especialidad];
    }
}
