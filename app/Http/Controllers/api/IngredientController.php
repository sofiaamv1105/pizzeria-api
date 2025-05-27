<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    /**
     * Listar todos los ingredientes.
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->json(['ingredients' => $ingredients]);
    }

    /**
     * Crear un nuevo ingrediente.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $ingredient = Ingredient::create($validated);

        return response()->json(['ingredient' => $ingredient], 201);
    }

    /**
     * Mostrar un ingrediente específico.
     */
    public function show(string $id)
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['error' => 'Ingrediente no encontrado.'], 404);
        }

        return response()->json(['ingredient' => $ingredient]);
    }

    /**
     * Actualizar un ingrediente existente.
     */
    public function update(Request $request, string $id)
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['error' => 'Ingrediente no encontrado.'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $ingredient->update($validated);

        return response()->json(['ingredient' => $ingredient]);
    }

    /**
     * Eliminar un ingrediente.
     */
    public function destroy(string $id)
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['error' => 'Ingrediente no encontrado.'], 404);
        }

        $ingredient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ingrediente eliminado correctamente.'
        ]);
    }
}