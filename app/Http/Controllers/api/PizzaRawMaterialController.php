<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PizzaRawMaterial;

class PizzaRawMaterialController extends Controller
{
    /**
     * Listar todos los registros.
     */
    public function index()
    {
        $pizzaRawMaterials = PizzaRawMaterial::with(['pizza', 'rawMaterial'])->get();
        return response()->json(['pizza_raw_materials' => $pizzaRawMaterials]);
    }

    /**
     * Crear una nueva relación.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0.01',
        ]);

        $pizzaRawMaterial = PizzaRawMaterial::create($validated);

        return response()->json(['pizza_raw_material' => $pizzaRawMaterial], 201);
    }

    /**
     * Mostrar un registro individual.
     */
    public function show(string $id)
    {
        $pizzaRawMaterial = PizzaRawMaterial::with(['pizza', 'rawMaterial'])->find($id);

        if (!$pizzaRawMaterial) {
            return response()->json(['error' => 'Relación no encontrada.'], 404);
        }

        return response()->json(['pizza_raw_material' => $pizzaRawMaterial]);
    }

    /**
     * Actualizar una relación existente.
     */
    public function update(Request $request, string $id)
    {
        $pizzaRawMaterial = PizzaRawMaterial::find($id);

        if (!$pizzaRawMaterial) {
            return response()->json(['error' => 'Relación no encontrada.'], 404);
        }

        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0.01',
        ]);

        $pizzaRawMaterial->update($validated);

        return response()->json(['pizza_raw_material' => $pizzaRawMaterial]);
    }

    /**
     * Eliminar una relación.
     */
    public function destroy(string $id)
    {
        $pizzaRawMaterial = PizzaRawMaterial::find($id);

        if (!$pizzaRawMaterial) {
            return response()->json(['error' => 'Relación no encontrada.'], 404);
        }

        $pizzaRawMaterial->delete();

        return response()->json(['message' => 'Relación eliminada correctamente.']);
    }
}