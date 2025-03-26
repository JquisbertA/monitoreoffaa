<?php

namespace App\Http\Controllers;

use App\MapaCeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapaCeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // En tu LocationController
    public function index()
    {
        $locations = MapaCeo::all()->map(function($location) {
            return [
                'id' => $location->id,
                'name' => $location->name,
                'description' => $location->description,
                'lat' => $location->lat,
                'lng' => $location->lng,
                'image_url' => $location->image_path ? asset($location->image_path) : null
                // o 'image_path' => asset($location->image_path)
            ];
        });
        
        return response()->json($locations);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $location = new MapaCeo($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/mapa_ceos');
            $location->image_path = str_replace('public/', 'storage/', $path);
        }

        $location->save();

        return response()->json([
            'id' => $location->id,
            'name' => $location->name,
            'description' => $location->description,
            'lat' => $location->lat,
            'lng' => $location->lng,
            'image_url' => $location->image_path ? asset($location->image_path) : null
        ], 201);
    }

    public function update(Request $request, MapaCeo $mapaCeo) // Cambiado el nombre del parámetro
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'sometimes|string' // Cambiado a string
        ]);

        // Convertir remove_image a booleano
        $removeImage = filter_var($request->input('remove_image', false), FILTER_VALIDATE_BOOLEAN);

        // Eliminar imagen si se solicita
        if ($removeImage && $mapaCeo->image_path) {
            Storage::delete(str_replace('storage/', 'public/', $mapaCeo->image_path));
            $validated['image_path'] = null;
        }

        // Manejar nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($mapaCeo->image_path) {
                Storage::delete(str_replace('storage/', 'public/', $mapaCeo->image_path));
            }
            
            $path = $request->file('image')->store('public/mapa_ceos');
            $validated['image_path'] = str_replace('public/', 'storage/', $path);
        }

        // Actualizar el modelo
        $mapaCeo->update($validated);

        return response()->json([
            'id' => $mapaCeo->id,
            'name' => $mapaCeo->name,
            'description' => $mapaCeo->description,
            'lat' => $mapaCeo->lat,
            'lng' => $mapaCeo->lng,
            'image_url' => $mapaCeo->image_path ? asset($mapaCeo->image_path) : null
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MapaCeo  $mapaCeo
     * @return \Illuminate\Http\Response
     */
    public function show(MapaCeo $mapaCeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MapaCeo  $mapaCeo
     * @return \Illuminate\Http\Response
     */
    public function edit(MapaCeo $mapaCeo)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MapaCeo  $mapaCeo
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        try {
            $location = MapaCeo::findOrFail($id);
            $location->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Marcador eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el marcador'
            ], 500);
        }
    }
}
