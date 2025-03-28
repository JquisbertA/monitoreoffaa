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

    public function update(Request $request, $id)
    {
        $location = MapaCeo::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Manejo de imágenes
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($location->image_path) {
                Storage::delete(str_replace('storage/', 'public/', $location->image_path));
            }
            
            $path = $request->file('image')->store('public/locations');
            $location->image_path = str_replace('public/', 'storage/', $path);
        }
        elseif ($request->input('keep_image') === 'true') {
            // Mantener la imagen existente (no hacer nada)
        }
        else {
            // Eliminar imagen si no se está manteniendo y no se subió nueva
            if ($location->image_path) {
                Storage::delete(str_replace('storage/', 'public/', $location->image_path));
                $location->image_path = null;
            }
        }

        $location->fill($validated);
        $location->save();

        return response()->json([
            'id' => $location->id,
            'name' => $location->name,
            'description' => $location->description,
            'lat' => $location->lat,
            'lng' => $location->lng,
            'image_path' => $location->image_path,
            'image_url' => $location->image_path ? asset($location->image_path) : null
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
