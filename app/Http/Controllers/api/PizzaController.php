<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{
    /**
     * Listar todas las pizzas con sus relaciones.
     */
    public function index()
    {
        $pizzas = Pizza::with('sizes', 'ingredients', 'rawMaterials')->get();
        return response()->json(['pizzas' => $pizzas]);
    }

    /**
     * Crear una nueva pizza.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pizza = Pizza::create([
            'name' => $request->name,
        ]);

        return response()->json(['pizza' => $pizza], 201);
    }

    /**
     * Mostrar una pizza específica con sus relaciones.
     */
    public function show(string $id)
    {
        $pizza = Pizza::with('sizes', 'ingredients', 'rawMaterials')->find($id);

        if (!$pizza) {
            return response()->json(['error' => 'Pizza no encontrada.'], 404);
        }

        return response()->json(['pizza' => $pizza]);
    }

    /**
     * Actualizar una pizza existente.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pizza = Pizza::find($id);

        if (!$pizza) {
            return response()->json(['error' => 'Pizza no encontrada.'], 404);
        }

        $pizza->update([
            'name' => $request->name,
        ]);

        return response()->json(['pizza' => $pizza]);
    }

    /**
     * Eliminar una pizza.
     */
    public function destroy(string $id)
    {
        try {
            $pizza = Pizza::findOrFail($id);
            $pizza->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pizza eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'No se pudo eliminar la pizza.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}