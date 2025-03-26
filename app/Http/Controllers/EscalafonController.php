<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscalafonController extends Controller
{
    public function CrearEscalafon(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
    }

    public function EditarEscalafon(Request $request) //BASE
    {
        
    }

    public function EliminarEscalafon(Request $request) //BASE
    {
        
    }

    public function ListarEscalafon(Request $request) //BASE
    {
        // $entidad = $request->id_entidad;
        
        $escalafon = DB::table('escalafon')
                ->select('id', 'escalafon', 'abreviatura', 'estado')
                ->where('estado', 1)
                // ->where('id_entidad', $entidad)
                ->orderBy('id', 'asc')
                ->get();
                return ['escalafon' => $escalafon];
    }
}
