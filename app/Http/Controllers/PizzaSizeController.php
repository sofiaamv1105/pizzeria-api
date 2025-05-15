<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PizzaSize;
use App\Models\Pizza;


class PizzaSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzaSizes = PizzaSize::with('pizza')->get();
        return view('pizza_sizes.index', compact('pizzaSizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = Pizza::all();
        return view('pizza_sizes.create', compact('pizzas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|in:pequeña,mediana,grande',
            'price' => 'required|numeric|min:0',
        ]);

        PizzaSize::create($validated);

        return redirect()->route('pizza_sizes.index')->with('success', 'Tamaño de pizza creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pizzaSize = PizzaSize::findOrFail($id);
        $pizzas = Pizza::all();
        return view('pizza_sizes.edit', compact('pizzaSize', 'pizzas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizzaSize = PizzaSize::findOrFail($id);
        $validated = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|in:pequeña,mediana,grande',
            'price' => 'required|numeric|min:0',
        ]);

        $pizzaSize->update($validated);

        return redirect()->route('pizza_sizes.index')->with('success', 'Tamaño de pizza actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizzaSize = PizzaSize::findOrFail($id);
        $pizzaSize->delete();
        return redirect()->route('pizza_sizes.index')->with('success', 'Tamaño de pizza eliminado');
    }
}
