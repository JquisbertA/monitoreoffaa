<?php

namespace App\Http\Controllers;

use App\GranUnidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GranUnidadController extends Controller
{
    //
    public function Guardar(Request $request)
    {
        GranUnidad::create([
            'id_fuerza'   =>$request->id_fuerza,
            'gran_unidad'   =>$request->gran_unidad,
            'abreviatura'   =>$request->abreviatura,
            'descripcion'   =>$request->descripcion,
            'lat'   =>$request->latitud,
            'lng' =>$request->longitud,
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
            $data = DB::table('gran_unidads')
            ->join('fuerza','gran_unidads.id_fuerza','=','fuerza.id')
            ->select('gran_unidads.*','fuerza.fuerza')
            ->orderBy('id')->get();
        }
        else{
            $data = DB::table('gran_unidads')
            ->join('fuerza','gran_unidads.id_fuerza','=','fuerza.id')
            ->select('gran_unidads.*','fuerza.fuerza')
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

    public function selectbuscarGranUnidad(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $gran_unidad = DB::table('gran_unidads')
        ->where('id_fuerza','=',$buscar)
        ->where('estado','=','1')
        ->select('id','gran_unidad')
        ->orderBy('gran_unidad', 'asc')->get();
        return ['gran_unidad' => $gran_unidad];
    }
}
