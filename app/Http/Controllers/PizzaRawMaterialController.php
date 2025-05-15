<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PizzaRawMaterial;
use App\Models\Pizza;
use App\Models\RawMaterial;

class PizzaRawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzaRawMaterials = PizzaRawMaterial::with('pizza', 'rawMaterial')->get();
        return view('pizza_raw_materials.index', compact('pizzaRawMaterials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = Pizza::all();
        $rawMaterials = RawMaterial::all();
        return view('pizza_raw_materials.create', compact('pizzas', 'rawMaterials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0.01',
        ]);

        PizzaRawMaterial::create($request->all());
        return redirect()->route('pizza_raw_materials.index')->with('success', 'Relación creada correctamente.');
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
        $pizzaRawMaterial = PizzaRawMaterial::findOrFail($id);
        $pizzas = Pizza::all();
        $rawMaterials = RawMaterial::all();
        return view('pizza_raw_materials.edit', compact('pizzaRawMaterial', 'pizzas', 'rawMaterials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizzaRawMaterial = PizzaRawMaterial::findOrFail($id);
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0.01',
        ]);

        $pizzaRawMaterial->update($request->all());
        return redirect()->route('pizza_raw_materials.index')->with('success', 'Relación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizzaRawMaterial = PizzaRawMaterial::findOrFail($id);
        $pizzaRawMaterial->delete();
        return redirect()->route('pizza_raw_materials.index')->with('success', 'Relación eliminada correctamente.');
    }
}
