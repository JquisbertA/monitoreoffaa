<?php

namespace App\Http\Controllers;

use App\PeqUnidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeqUnidadController extends Controller
{
    //
    public function Guardar(Request $request)
    {
        PeqUnidad::create([
            'id_fuerza'   =>$request->id_fuerza,
            'id_gran_unidad'   =>$request->id_granunidad,
            'peq_unidad'   =>$request->peq_unidad,
            'abreviatura'   =>$request->abreviatura,
            'descripcion'   =>$request->descripcion,
            'lat'   =>$request->latitud,
            'lng' =>$request->longitud,
            'estado'       =>'1',
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
            $data = DB::table('peq_unidads')
            ->join('fuerza','peq_unidads.id_fuerza','=','fuerza.id')
            ->join('gran_unidads','peq_unidads.id_gran_unidad','=','gran_unidads.id')
            ->select('peq_unidads.*','fuerza.fuerza','gran_unidads.gran_unidad')
            ->orderBy('id')->get();
        }
        else{
            $data = DB::table('peq_unidads')
            ->join('fuerza','peq_unidads.id_fuerza','=','fuerza.id')
            ->join('gran_unidads','peq_unidads.id_gran_unidad','=','gran_unidads.id')
            ->select('peq_unidads.*','fuerza.fuerza','gran_unidads.gran_unidad')
            ->orderBy('id')
            ->where(function ($q) use ($buscar){
                $q->where('gran_unidad','like','%'.$buscar.'%')
                ->orwhere('descripcion','like','%'.$buscar.'%');
            })->get();
            /* ->where('descripcion','like','%'.$request->buscar.'%')
            ->get(); */
        }

        return response()->json($data);
    }
}
