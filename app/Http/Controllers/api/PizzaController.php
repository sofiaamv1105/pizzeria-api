<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pizza;
use Illuminate\Support\Facades\DB;


class PizzaController extends Controller
{
    /**
     * Listar todas las pizzas con sus relaciones.
     */
    public function index()
    {
        $pizzas = DB::table('pizzas')
            ->select('id', 'name')
            ->with(['sizes', 'ingredients', 'rawMaterials'])
            ->get();
        return json_encode(['pizzas' => $pizzas]);
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

        return json_encode(['pizza' => $pizza], 201);
    }

    /**
     * Mostrar una pizza específica con sus relaciones.
     */
    public function show(string $id)
    {
        $pizza = Pizza::with('sizes', 'ingredients', 'rawMaterials')->find($id);

        if (!$pizza) {
            return json_encode(['error' => 'Pizza no encontrada.'], 404);
        }

        return json_encode(['pizza' => $pizza]);
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
           return json_encode(['error' => 'Pizza no encontrada.'], 404);
        }

        $pizza->update([
            'name' => $request->name,
        ]);

        return json_encode(['pizza' => $pizza]);
    }

    /**
     * Eliminar una pizza.
     */
    public function destroy(string $id)
    {
        try {
            $pizza = Pizza::findOrFail($id);
            $pizza->delete();

           return json_encode([
                'success' => true,
                'message' => 'Pizza eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'error' => 'No se pudo eliminar la pizza.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}