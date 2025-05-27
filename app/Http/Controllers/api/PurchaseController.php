<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    /**
     * Listar todas las compras con sus proveedores y materias primas.
     */
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'rawMaterial'])->get();
        return response()->json(['purchases' => $purchases]);
    }

    /**
     * Guardar una nueva compra.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $purchase = Purchase::create($validated);

        return response()->json(['purchase' => $purchase, 'message' => 'Compra registrada con éxito.'], 201);
    }

    /**
     * Mostrar una compra específica.
     */
    public function show($id)
    {
        $purchase = Purchase::with(['supplier', 'rawMaterial'])->find($id);

        if (!$purchase) {
            return response()->json(['error' => 'Compra no encontrada.'], 404);
        }

        return response()->json(['purchase' => $purchase]);
    }

    /**
     * Actualizar una compra existente.
     */
    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json(['error' => 'Compra no encontrada.'], 404);
        }

        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $purchase->update($validated);

        return response()->json(['purchase' => $purchase, 'message' => 'Compra actualizada con éxito.']);
    }

    /**
     * Eliminar una compra.
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json(['error' => 'Compra no encontrada.'], 404);
        }

        $purchase->delete();

        return response()->json(['message' => 'Compra eliminada con éxito.']);
    }
}