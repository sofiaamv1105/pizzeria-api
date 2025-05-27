<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PizzaSize;

class PizzaSizeController extends Controller
{
    /**
     * Listar todos los tamaños de pizza.
     */
    public function index()
    {
        $pizzaSizes = PizzaSize::with('pizza')->get();
        return response()->json(['pizza_sizes' => $pizzaSizes]);
    }

    /**
     * Crear un nuevo tamaño de pizza.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|in:pequeña,mediana,grande',
            'price' => 'required|numeric|min:0',
        ]);

        $pizzaSize = PizzaSize::create($validated);

        return response()->json(['pizza_size' => $pizzaSize], 201);
    }

    /**
     * Mostrar un tamaño de pizza específico.
     */
    public function show(string $id)
    {
        $pizzaSize = PizzaSize::with('pizza')->find($id);

        if (!$pizzaSize) {
            return response()->json(['error' => 'Tamaño de pizza no encontrado.'], 404);
        }

        return response()->json(['pizza_size' => $pizzaSize]);
    }

    /**
     * Actualizar un tamaño de pizza existente.
     */
    public function update(Request $request, string $id)
    {
        $pizzaSize = PizzaSize::find($id);

        if (!$pizzaSize) {
            return response()->json(['error' => 'Tamaño de pizza no encontrado.'], 404);
        }

        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|in:pequeña,mediana,grande',
            'price' => 'required|numeric|min:0',
        ]);

        $pizzaSize->update($validated);

        return response()->json(['pizza_size' => $pizzaSize]);
    }

    /**
     * Eliminar un tamaño de pizza.
     */
    public function destroy(string $id)
    {
        $pizzaSize = PizzaSize::find($id);

        if (!$pizzaSize) {
            return response()->json(['error' => 'Tamaño de pizza no encontrado.'], 404);
        }

        $pizzaSize->delete();

        return response()->json(['message' => 'Tamaño de pizza eliminado correctamente.']);
    }
}