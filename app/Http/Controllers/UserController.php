<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Listar todos los usuarios con sus relaciones client y employee.
     */
    public function index()
    {
        $users = User::with(['client', 'employee'])->get();
        return response()->json(['users' => $users]);
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:cliente,empleado',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        // Crear datos específicos según rol
        if ($user->role === 'cliente') {
            $user->client()->create([
                'address' => $request->input('address', ''),
                'phone'   => $request->input('phone', ''),
            ]);
        } elseif ($user->role === 'empleado') {
            $user->employee()->create([
                'position'              => $request->input('position', ''),
                'identification_number' => $request->input('identification_number', ''),
                'salary'                => $request->input('salary', 0),
                'hire_date'             => $request->input('hire_date', null),
            ]);
        }

        return response()->json(['user' => $user, 'message' => 'Usuario creado exitosamente.'], 201);
    }

    /**
     * Mostrar un usuario específico con sus relaciones.
     */
    public function show($id)
    {
        $user = User::with(['client', 'employee'])->find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        return response()->json(['user' => $user]);
    }

    /**
     * Actualizar un usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role'     => ['required', Rule::in(['cliente', 'empleado'])],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        // Actualizar o crear datos según rol
        if ($user->role === 'cliente') {
            $user->client()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => $request->input('address', ''),
                    'phone'   => $request->input('phone', ''),
                ]
            );
            // En caso que rol cambie, eliminar relación employee si existe
            $user->employee()->delete();
        } elseif ($user->role === 'empleado') {
            $user->employee()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'position'              => $request->input('position', ''),
                    'identification_number' => $request->input('identification_number', ''),
                    'salary'                => $request->input('salary', 0),
                    'hire_date'             => $request->input('hire_date', null),
                ]
            );
            // En caso que rol cambie, eliminar relación client si existe
            $user->client()->delete();
        }

        return response()->json(['user' => $user, 'message' => 'Usuario actualizado correctamente.']);
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
}