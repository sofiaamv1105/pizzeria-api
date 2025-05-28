<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Branch;
use App\Models\Employee;

class OrderController extends Controller
{
    /**
     * Listar todos los pedidos.
     */
    public function index()
    {
        $orders = Order::with(['client.user', 'branch', 'deliveryPerson'])->get();
        return response()->json(['orders' => $orders]);
    }

    /**
     * Crear un nuevo pedido.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'branch_id' => 'required|exists:branches,id',
            'delivery_person_id' => 'nullable|exists:employees,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pendiente,en_preparacion,listo,entregado',
            'delivery_type' => 'required|in:en_local,a_domicilio',
        ]);

        $order = Order::create($validated);

        return response()->json(['order' => $order], 201);
    }

    /**
     * Mostrar un pedido específico.
     */
    public function show(string $id)
    {
        $order = Order::with(['client', 'branch', 'deliveryPerson'])->find($id);

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        return response()->json(['order' => $order]);
    }

    /**
     * Actualizar un pedido.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'branch_id' => 'required|exists:branches,id',
            'delivery_person_id' => 'nullable|exists:employees,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pendiente,en_preparacion,listo,entregado',
            'delivery_type' => 'required|in:en_local,a_domicilio',
        ]);

        $order->update($validated);

        return response()->json(['order' => $order]);
    }

    /**
     * Eliminar un pedido.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pedido eliminado correctamente.'
        ]);
    }
}