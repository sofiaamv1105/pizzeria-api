<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Mostrar todas las sucursales.
     */
    public function index()
    {
        $branches = Branch::all();
        return response()->json(['branches' => $branches]);
    }

    /**
     * Almacenar una nueva sucursal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $branch = Branch::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json(['branch' => $branch], 201);
    }

    /**
     * Mostrar una sucursal específica.
     */
    public function show(string $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['error' => 'Sucursal no encontrada.'], 404);
        }

        return response()->json(['branch' => $branch]);
    }

    /**
     * Actualizar una sucursal existente.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['error' => 'Sucursal no encontrada.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json(['branch' => $branch]);
    }

    /**
     * Eliminar una sucursal.
     */
    public function destroy(string $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            $branch->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sucursal eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'No se pudo eliminar la sucursal.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}