<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraIngredient;

class ExtraIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extraIngredients = ExtraIngredient::all();
        return view('extra_ingredients.index', compact('extraIngredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('extra_ingredients.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        ExtraIngredient::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('extra_ingredients.index')->with('success', 'Ingrediente extra creado correctamente.');
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
        $extraIngredient = ExtraIngredient::findOrFail($id);
        return view('extra_ingredients.edit', compact('extraIngredient'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $extraIngredient = ExtraIngredient::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $extraIngredient->update($request->all());
        return redirect()->route('extra_ingredients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $extraIngredient = ExtraIngredient::findOrFail($id);
        $extraIngredient->delete();
        return redirect()->route('extra_ingredients.index');
    }
}
