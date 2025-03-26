<?php

namespace App\Http\Controllers;

use App\Ceo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CeoController extends Controller
{
    //
    public function Guardar(Request $request)
    {
        Ceo::create([
            'nombre'   =>$request->nombre,
            'sigla'   =>$request->sigla,
            'descripcion'   =>$request->descripcion,
            'region'   =>$request->region,
            'coordenadas' =>$request->coordenada,
            'sysuser'       =>'SYSTEM',
            'estado'       =>'1'
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    public function Listar(Request $request)
    {
        $buscar = $request->buscar;
        if ($request->buscar == ''){
            $data = DB::table('ceo')->orderBy('id')->get();
        }
        else{
            $data = DB::table('ceo')
            ->orderBy('id')
            ->where(function ($q) use ($buscar){
                $q->where('nombre','like','%'.$buscar.'%')
                ->orwhere('region','like','%'.$buscar.'%');
            })->get();
            /* ->where('descripcion','like','%'.$request->buscar.'%')
            ->get(); */
        }

        return response()->json($data);
    }

    public function Datos(Request $request){
        $data = DB::table('ceo')
        ->select('*')
        ->where('id',$request->id)
        ->first();

        return response()->json($data);
    }

    public function Editar(Request $request)
    {
        Ceo::where('id',$request->id)
        ->update([

            'nombre'   =>$request->nombre,
            'sigla'   =>$request->sigla,
            'descripcion'   =>$request->descripcion,
            'region'   =>$request->region,
            'coordenadas' =>$request->coordenadas,
            'sysuser'       =>'SYSTEM',
            'estado'       =>'1'
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    public function CambioEstado(Request $request)
    {
        $estado = 1 - $request->estado;

        //Otra forma es
        Ceo::where('id',$request->id)
        ->update([
            'estado' => $estado
        ]);

        return response()->json([
            'code' => 200
        ]);
    }
}
