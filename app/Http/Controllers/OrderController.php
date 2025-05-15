<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Branch;
use App\Models\Employee;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['client', 'branch', 'deliveryPerson'])->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $branches = Branch::all();
        $employees = Employee::all();
        return view('orders.create', compact('clients', 'branches', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
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

        Order::create($validated);
        return redirect()->route('orders.index')->with('success', 'Pedido creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $clients = Client::all();
        $branches = Branch::all();
        $employees = Employee::all();
        return view('orders.edit', compact('order', 'clients', 'branches', 'employees'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'branch_id' => 'required|exists:branches,id',
            'delivery_person_id' => 'nullable|exists:employees,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pendiente,en_preparacion,listo,entregado',
            'delivery_type' => 'required|in:en_local,a_domicilio',
        ]);

        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Pedido actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pedido eliminado correctamente.');
    }
}
