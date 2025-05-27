<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Listar todos los proveedores.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json(['suppliers' => $suppliers]);
    }

    /**
     * Guardar un nuevo proveedor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::create($validated);

        return response()->json(['supplier' => $supplier, 'message' => 'Proveedor creado correctamente.'], 201);
    }

    /**
     * Mostrar un proveedor específico.
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Proveedor no encontrado.'], 404);
        }

        return response()->json(['supplier' => $supplier]);
    }

    /**
     * Actualizar un proveedor.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Proveedor no encontrado.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
        ]);

        $supplier->update($validated);

        return response()->json(['supplier' => $supplier, 'message' => 'Proveedor actualizado correctamente.']);
    }

    /**
     * Eliminar un proveedor.
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Proveedor no encontrado.'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Proveedor eliminado correctamente.']);
    }
}