<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Listar todos los clientes con sus usuarios relacionados.
     */
    public function index()
    {
        $clients = Client::with('user')->get();
        return response()->json(['clients' => $clients]);
    }

    /**
     * Crear un nuevo cliente.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $client = Client::create($validated);

        return response()->json(['client' => $client], 201);
    }

    /**
     * Mostrar un cliente específico.
     */
    public function show(string $id)
    {
        $client = Client::with('user')->find($id);

        if (!$client) {
            return response()->json(['error' => 'Cliente no encontrado.'], 404);
        }

        return response()->json(['client' => $client]);
    }

    /**
     * Actualizar un cliente existente.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['error' => 'Cliente no encontrado.'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $client->update($validated);

        return response()->json(['client' => $client]);
    }

    /**
     * Eliminar un cliente.
     */
    public function destroy(string $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cliente eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'No se pudo eliminar el cliente.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}