<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderExtraIngredient;
use Illuminate\Http\Request;

class OrderExtraIngredientController extends Controller
{
    /**
     * Listar todos los registros.
     */
    public function index()
    {
        $orderExtraIngredients = OrderExtraIngredient::with(['order', 'extraIngredient'])->get();
        return response()->json(['order_extra_ingredients' => $orderExtraIngredients]);
    }

    /**
     * Crear un nuevo registro.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderExtraIngredient = OrderExtraIngredient::create($validated);

        return response()->json(['order_extra_ingredient' => $orderExtraIngredient], 201);
    }

    /**
     * Mostrar un registro específico.
     */
    public function show(string $id)
    {
        $record = OrderExtraIngredient::with(['order', 'extraIngredient'])->find($id);

        if (!$record) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        return response()->json(['order_extra_ingredient' => $record]);
    }

    /**
     * Actualizar un registro específico.
     */
    public function update(Request $request, string $id)
    {
        $record = OrderExtraIngredient::find($id);

        if (!$record) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $record->update($validated);

        return response()->json(['order_extra_ingredient' => $record]);
    }

    /**
     * Eliminar un registro específico.
     */
    public function destroy(string $id)
    {
        $record = OrderExtraIngredient::find($id);

        if (!$record) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Registro eliminado correctamente.']);
    }
}