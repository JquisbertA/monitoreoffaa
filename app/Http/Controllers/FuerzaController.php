<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuerzaController extends Controller
{
    public function CrearFuerza(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
    }

    public function EditarFuerza(Request $request) //BASE
    {
        
    }

    public function EliminarFuerza(Request $request) //BASE
    {
        
    }

    public function ListarFuerza(Request $request) //BASE
    {
        // $entidad = $request->id_entidad;
        
        $fuerza = DB::table('fuerza')
                ->select('id', 'fuerza', 'abreviatura', 'estado')
                ->where('estado', 1)
                // ->where('id_entidad', $entidad)
                ->orderBy('id', 'asc')
                ->get();
                return ['fuerza' => $fuerza];
    }

    /* public function SelectFuerza(Request $request){
        if (!$request->ajax()) {
            return response()->json(['error' => 'Acceso no permitido'], 403);
        }
        $fuerza = DB::table('fuerza')
        ->where('estado','=','1') 
        ->select('id','fuerza')
        ->orderBy('id','asc')->get();

        return ['fuerza' => $fuerza]; 
    } */

    public function SelectFuerza(Request $request)
    {
        abort_if(!$request->ajax(), 403, 'Acceso no permitido');

        $fuerza = DB::table('fuerza')
            ->where('estado', 1)
            ->orderBy('id')
            ->get(['id', 'fuerza']);

        return response()->json($fuerza);
    }

}
