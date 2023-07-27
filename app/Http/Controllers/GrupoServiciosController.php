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
            $data = DB::table('grupo_servicios')->orderBy('id')->get();
        }
        else{
            $data = DB::table('grupo_servicios')
            ->orderBy('id')
            ->where(function ($q) use ($buscar){
                $q->where('descripcion','like','%'.$buscar.'%')
                ->orwhere('observaciones','like','%'.$buscar.'%');
            })->get();
            /* ->where('descripcion','like','%'.$request->buscar.'%')
            ->get(); */
        }

        return response()->json($data);
    }

    public function Datos(Request $request){
        $data = DB::table('grupo_servicios')
        ->select('descripcion','observaciones')
        ->where('id',$request->id)
        ->first();

        return response()->json($data);
    }

    public function Editar(Request $request)
    {
        GrupoServicios::where('id',$request->id)
        ->update([
            'descripcion' => $request->descripcion,
            'observaciones' => $request->observaciones
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    public function CambioEstado(Request $request)
    {
        $estado = 1 - $request->estado;

        //Otra forma es
        GrupoServicios::where('id',$request->id)
        ->update([
            'estado' => $estado
        ]);

        return response()->json([
            'code' => 200
        ]);
    }
}
