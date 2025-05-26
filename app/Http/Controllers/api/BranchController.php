<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Mostrar todas las sucursales.
     */
    public function index()
    {
        $branches = DB ::table("branches")
            ->select("id", "name", "address")
            ->get();
       return json_encode(['branches' => $branches]);
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

        return json_encode(['branch' => $branch], 201);
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

        return json_encode(['branch' => $branch]);
    }

    /**
     * Actualizar una sucursal existente.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return json_encode(['error' => 'Sucursal no encontrada.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return json_encode(['branch' => $branch]);
    }

    /**
     * Eliminar una sucursal.
     */
    public function destroy(string $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            $branch->delete();

            return json_encode([
                'success' => true,
                'message' => 'Sucursal eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'error' => 'No se pudo eliminar la sucursal.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}