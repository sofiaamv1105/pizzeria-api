<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderPizza;
use Illuminate\Http\Request;

class OrderPizzaController extends Controller
{
    /**
     * Listar todos los registros de pizzas por pedido.
     */
    public function index()
    {
        $orderPizzas = OrderPizza::with(['order', 'pizzaSize'])->get();
        return response()->json(['order_pizzas' => $orderPizzas]);
    }

    /**
     * Crear un nuevo registro.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'pizza_size_id' => 'required|exists:pizza_size,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderPizza = OrderPizza::create($validated);

        return response()->json(['order_pizza' => $orderPizza], 201);
    }

    /**
     * Mostrar un registro específico.
     */
    public function show(string $id)
    {
        $record = OrderPizza::with(['order', 'pizzaSize'])->find($id);

        if (!$record) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        return response()->json(['order_pizza' => $record]);
    }

    /**
     * Actualizar un registro específico.
     */
    public function update(Request $request, string $id)
    {
        $orderPizza = OrderPizza::find($id);

        if (!$orderPizza) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'pizza_size_id' => 'required|exists:pizza_size,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderPizza->update($validated);

        return response()->json(['order_pizza' => $orderPizza]);
    }

    /**
     * Eliminar un registro específico.
     */
    public function destroy(string $id)
    {
        $orderPizza = OrderPizza::find($id);

        if (!$orderPizza) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $orderPizza->delete();

        return response()->json(['message' => 'Registro eliminado correctamente.']);
    }
}