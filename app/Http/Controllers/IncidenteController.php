<?php

namespace App\Http\Controllers;


use App\Incidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IncidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function Listar(Request $request)
     {
         $buscar = $request->buscar;
         if ($request->buscar == ''){
             $data = DB::table('incidentes')->orderBy('id_incidente')->get();
         }
         else{
             $data = DB::table('incientes')
             ->orderBy('id_incidente')
             ->where(function ($q) use ($buscar){
                 $q->where('tipo','like','%'.$buscar.'%')
                 ->orwhere('descripcion','like','%'.$buscar.'%');
             })->get();
             /* ->where('descripcion','like','%'.$request->buscar.'%')
             ->get(); */
         }
 
         return response()->json($data);
     }



     public function Guardar(Request $request)
     {
       


         Incidente::create([
         
             'tipo' =>$request->tipo,
             'descripcion' =>$request->descripcion,
             'id_ceo' =>$request->id_ceo,
             'coordenadas_incidente' =>$request->coordenadas_incidente,

             
             'sysuser'       =>'SYSTEM'
         ]);
 
         return response()->json([
             'code' => 200
         ]);
     }



    public function index()
    {
        $incidentes = Incidente::all();
        return view('incidentes.index', compact('incidentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Tipo' => 'required|string',
            'Descripción' => 'required',
            'ID_CEO' => 'required|exists:ceos,id',
            'Fecha_Hora' => 'required|date',
            'Coordenadas_incidente' => 'required|string',
            'Estado' => 'required|in:Abierto,En progreso,Cerrado'
        ]);

        Incidente::create($request->all());

        return redirect()->route('incidentes.index')->with('success', 'Incidente creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('incidentes.show', compact('incidente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('incidentes.edit', compact('incidente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Tipo' => 'required|string',
            'Descripción' => 'required',
            'ID_CEO' => 'required|exists:ceos,id',
            'Fecha_Hora' => 'required|date',
            'Coordenadas_Incidente' => 'required|string',
            'Estado' => 'required|in:Abierto,En progreso,Cerrado'
        ]);

        $incidente->update($request->all());

        return redirect()->route('incidentes.index')->with('success', 'Incidente actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incidente->delete();
        return redirect()->route('incidentes.index')->with('success', 'Incidente eliminado con éxito.');
    }
}
