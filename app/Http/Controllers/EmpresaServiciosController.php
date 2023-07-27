<?php

namespace App\Http\Controllers;

use App\EmpresaServicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaServiciosController extends Controller
{
    //Funcion para guardar la data
    public function Guardar(Request $request)
    {
        EmpresaServicios::create([
            'sigla' =>$request->sigla,
            'descripcion'   =>$request->descripcion,
            'codigo' =>$request->codigo,
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
            $data = DB::table('empresa_servicios')->orderBy('id')->get();
        }
        else{
            $data = DB::table('empresa_servicios')
            ->orderBy('id')
            ->where(function ($q) use ($buscar){
                $q->where('descripcion','like','%'.$buscar.'%')
                ->orwhere('codigo','like','%'.$buscar.'%');
            })->get();
            /* ->where('descripcion','like','%'.$request->buscar.'%')
            ->get(); */
        }

        return response()->json($data);
    }

    public function Datos(Request $request){
        $data = DB::table('empresa_servicios')
        ->select('sigla','descripcion','codigo')
        ->where('id',$request->id)
        ->first();

        return response()->json($data);
    }

    public function Editar(Request $request)
    {
        EmpresaServicios::where('id',$request->id)
        ->update([
            'sigla' => $request->sigla,
            'descripcion' => $request->descripcion,
            'codigo' => $request->codigo
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    public function CambioEstado(Request $request)
    {
        $estado = 1 - $request->estado;

        //Otra forma es
        EmpresaServicios::where('id',$request->id)
        ->update([
            'estado' => $estado
        ]);

        return response()->json([
            'code' => 200
        ]);
    }
}
