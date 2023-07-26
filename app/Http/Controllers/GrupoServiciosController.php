<?php

namespace App\Http\Controllers;

use App\GrupoServicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoServiciosController extends Controller
{
    //Funcion para guardar la data
    public function Guardar(Request $request)
    {
        GrupoServicios::create([
            'descripcion'   =>$request->descripcion,
            'observaciones' =>$request->observaciones,
            'sysuser'       =>'SYSTEM'
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    public function Listar(Request $request)
    {
        $buscar = $request->buscar;
        if ($request->buscar == ''){
            $data = DB::table('grupo_servicios')->get();
        }
        else{
            $data = DB::table('grupo_servicios')
            ->where(function ($q) use ($buscar){
                $q->where('descripcion','like','%'.$buscar.'%')
                ->orwhere('observaciones','like','%'.$buscar.'%');
            })->get();
            /* ->where('descripcion','like','%'.$request->buscar.'%')
            ->get(); */
        }

        return response()->json($data);
    }
}
