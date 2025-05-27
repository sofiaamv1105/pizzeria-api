<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExtraIngredient;

class ExtraIngredientController extends Controller
{
    /**
     * Listar todos los ingredientes extra.
     */
    public function index()
    {
        $extraIngredients = ExtraIngredient::all();
        return response()->json(['extra_ingredients' => $extraIngredients]);
    }

    /**
     * Almacenar un nuevo ingrediente extra.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $extraIngredient = ExtraIngredient::create($validated);

        return response()->json(['extra_ingredient' => $extraIngredient], 201);
    }

    /**
     * Mostrar un ingrediente extra específico.
     */
    public function show(string $id)
    {
        $extraIngredient = ExtraIngredient::find($id);

        if (!$extraIngredient) {
            return response()->json(['error' => 'Ingrediente extra no encontrado.'], 404);
        }

        return response()->json(['extra_ingredient' => $extraIngredient]);
    }

    /**
     * Actualizar un ingrediente extra existente.
     */
    public function update(Request $request, string $id)
    {
        $extraIngredient = ExtraIngredient::find($id);

        if (!$extraIngredient) {
            return response()->json(['error' => 'Ingrediente extra no encontrado.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $extraIngredient->update($validated);

        return response()->json(['extra_ingredient' => $extraIngredient]);
    }

    /**
     * Eliminar un ingrediente extra.
     */
    public function destroy(string $id)
    {
        $extraIngredient = ExtraIngredient::find($id);

        if (!$extraIngredient) {
            return response()->json(['error' => 'Ingrediente extra no encontrado.'], 404);
        }

        $extraIngredient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ingrediente extra eliminado correctamente.'
        ]);
    }
}