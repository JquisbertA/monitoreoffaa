<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArmaController extends Controller
{
    public function CrearArma(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
    }

    public function EditarArma(Request $request) //BASE
    {
        
    }

    public function EliminarArma(Request $request) //BASE
    {
        
    }

    public function ListarArma(Request $request) //BASE
    {
        $fuerza = $request->fuerza;
        
        $arma = DB::table('arma')
                ->select('id', 'id_fuerza', 'arma', 'abreviatura', 'estado')
                ->where('estado', 1)
                ->where('id_fuerza', $fuerza)
                ->orderBy('id', 'asc')
                ->get();
                return ['arma' => $arma];
    }
}
