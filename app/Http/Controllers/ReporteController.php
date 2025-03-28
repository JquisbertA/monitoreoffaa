<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function ReportePersonal(Request $request)
    {
        $id_personal = $request->id;

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
                ->where('p.id', $id_personal)
                ->get()
                ->first();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')."/".date('n')."/".date('Y');
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate( "No. LICENCIA: $personal->per_ci\nGRADO: $personal->abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nTITULO: $personal->licencia\nHABILITACION: $personal->habilitacion\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.reporte_personal',['personal'=>$personal,
                                                // 'qr'=>$codigo
                                                ])
        //8.3cm 5cm
        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream($personal->cm.'-'.$personal->ap_paterno.'.pdf');
        // return $pdf->download($personal->id_licencia.'-'.$personal->per_ci.'.pdf');

    }
}
