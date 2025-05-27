<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RawMaterial;

class RawMaterialController extends Controller
{
    /**
     * Listar todas las materias primas.
     */
    public function index()
    {
        $rawMaterials = RawMaterial::all();
        return response()->json(['rawMaterials' => $rawMaterials]);
    }

    /**
     * Guardar una nueva materia prima.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
        ]);

        $rawMaterial = RawMaterial::create($validated);

        return response()->json(['rawMaterial' => $rawMaterial, 'message' => 'Materia prima creada correctamente.'], 201);
    }

    /**
     * Mostrar una materia prima específica.
     */
    public function show($id)
    {
        $rawMaterial = RawMaterial::find($id);

        if (!$rawMaterial) {
            return response()->json(['error' => 'Materia prima no encontrada.'], 404);
        }

        return response()->json(['rawMaterial' => $rawMaterial]);
    }

    /**
     * Actualizar una materia prima.
     */
    public function update(Request $request, $id)
    {
        $rawMaterial = RawMaterial::find($id);

        if (!$rawMaterial) {
            return response()->json(['error' => 'Materia prima no encontrada.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
        ]);

        $rawMaterial->update($validated);

        return response()->json(['rawMaterial' => $rawMaterial, 'message' => 'Materia prima actualizada correctamente.']);
    }

    /**
     * Eliminar una materia prima.
     */
    public function destroy($id)
    {
        $rawMaterial = RawMaterial::find($id);

        if (!$rawMaterial) {
            return response()->json(['error' => 'Materia prima no encontrada.'], 404);
        }

        $rawMaterial->delete();

        return response()->json(['message' => 'Materia prima eliminada correctamente.']);
    }
}