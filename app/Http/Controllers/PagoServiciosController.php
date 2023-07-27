<?php

namespace App\Http\Controllers;

use App\PagoServicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoServiciosController extends Controller
{
    //Funcion para guardar la data
    public function Guardar(Request $request)
    {
        PagoServicios::create([
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
            $data = DB::table('modos_pago_servicios')->orderBy('id')->get();
        }
        else{
            $data = DB::table('modos_pago_servicios')
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
        $data = DB::table('modos_pago_servicios')
        ->select('descripcion','codigo')
        ->where('id',$request->id)
        ->first();

        return response()->json($data);
    }

    public function Editar(Request $request)
    {
        PagoServicios::where('id',$request->id)
        ->update([
            'descripcion' => $request->descripcion,
            'codigo' => $request->codigo
        ]);

        return response()->json([
            'code' => 200
        ]);
    }
}
