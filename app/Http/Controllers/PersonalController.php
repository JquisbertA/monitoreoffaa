<?php

namespace App\Http\Controllers;

use App\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    public function CrearPersonal(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
        Personal::create([
            'id_fuerza' => $request->id_fuerza,
            'id_escalafon' => $request->id_escalafon,
            'id_grado' => $request->id_grado,
            'id_especialidad' => $request->id_especialidad,
            'id_arma' => $request->id_arma,
            'nombre' => $request->nombre,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'ci' => $request->ci,
            'cm' => $request->cm
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    public function DatosPersonal(Request $request) //BASE
    {
        $id = $request->id;
        
        $personal = DB::table('personal as p')
                ->join('fuerza as f', 'p.id_fuerza', 'f.id')
                ->join('escalafon as e', 'p.id_escalafon', 'e.id')
                ->join('grado as g', 'p.id_grado', 'g.id')
                ->join('especialidad as es', 'p.id_especialidad', 'es.id')
                ->join('arma as a', 'p.id_arma', 'a.id')
                ->select('p.id as perid',
                        'f.id as fuerzaid', 
                        'f.fuerza', 
                        'f.abreviatura as fuerzaabreviatura',
                        'e.id as escalafonid',
                        'e.escalafon',
                        'g.id as gradoid',
                        'g.grado',
                        'g.abreviatura',
                        'es.id as especialidadid',
                        'es.especialidad',
                        'a.id as armaid',
                        'a.arma',
                        'p.nombre',
                        'p.ap_paterno',
                        'p.ap_materno',
                        'p.ci',
                        'p.cm')
                // ->where('estado', 1)
                ->where('p.id', $id)
                ->orderBy('p.ap_paterno', 'asc')
                ->orderBy('p.ap_materno', 'asc')
                ->orderBy('p.nombre', 'asc')
                ->get();
                return ['personal' => $personal];
    }

    public function EliminarPersonal(Request $request) //BASE
    {
        
    }

    public function ListarPersonal(Request $request) //BASE
    {
        // $fuerza = $request->fuerza;
        
        $personal = DB::table('personal as p')
                ->join('fuerza as f', 'p.id_fuerza', 'f.id')
                ->join('escalafon as e', 'p.id_escalafon', 'e.id')
                ->join('grado as g', 'p.id_grado', 'g.id')
                ->join('especialidad as es', 'p.id_especialidad', 'es.id')
                ->join('arma as a', 'p.id_arma', 'a.id')
                ->select('p.id as perid',
                        'f.id as fuerzaid', 
                        'f.fuerza', 
                        'f.abreviatura as fuerzaabreviatura',
                        'e.id as escalafonid',
                        'e.escalafon',
                        'g.id as gradoid',
                        'g.grado',
                        'g.abreviatura',
                        'es.id as especialidadid',
                        'es.especialidad',
                        'a.id as armaid',
                        'a.arma',
                        'p.nombre',
                        'p.ap_paterno',
                        'p.ap_materno',
                        'p.ci',
                        'p.cm')
                // ->where('estado', 1)
                // ->where('id_fuerza', $fuerza)
                ->orderBy('p.ap_paterno', 'asc')
                ->orderBy('p.ap_materno', 'asc')
                ->orderBy('p.nombre', 'asc')
                ->get();
                return ['personal' => $personal];
    }
}
