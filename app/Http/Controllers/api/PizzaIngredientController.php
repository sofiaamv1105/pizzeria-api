<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PizzaIngredient;
use Illuminate\Http\Request;

class PizzaIngredientController extends Controller
{
    /**
     * Listar todos los registros de ingredientes por pizza.
     */
    public function index()
    {
        $pizzaIngredients = PizzaIngredient::with(['pizza', 'ingredient'])->get();
        return response()->json(['pizza_ingredients' => $pizzaIngredients]);
    }

    /**
     * Guardar un nuevo ingrediente asociado a una pizza.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'ingredient_id' => 'required|exists:ingredients,id',
        ]);

        $pizzaIngredient = PizzaIngredient::create($validated);

        return response()->json(['pizza_ingredient' => $pizzaIngredient], 201);
    }

    /**
     * Mostrar un solo registro específico.
     */
    public function show(string $id)
    {
        $pizzaIngredient = PizzaIngredient::with(['pizza', 'ingredient'])->find($id);

        if (!$pizzaIngredient) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        return response()->json(['pizza_ingredient' => $pizzaIngredient]);
    }

    /**
     * Actualizar un ingrediente asociado a una pizza.
     */
    public function update(Request $request, string $id)
    {
        $pizzaIngredient = PizzaIngredient::find($id);

        if (!$pizzaIngredient) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'ingredient_id' => 'required|exists:ingredients,id',
        ]);

        $pizzaIngredient->update($validated);

        return response()->json(['pizza_ingredient' => $pizzaIngredient]);
    }

    /**
     * Eliminar el ingrediente de una pizza.
     */
    public function destroy(string $id)
    {
        $pizzaIngredient = PizzaIngredient::find($id);

        if (!$pizzaIngredient) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $pizzaIngredient->delete();

        return response()->json(['message' => 'Registro eliminado correctamente.']);
    }
}