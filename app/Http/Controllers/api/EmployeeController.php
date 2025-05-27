<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Mostrar todos los empleados con relación al usuario.
     */
    public function index()
    {
        $employees = Employee::with('user')->get();
        return response()->json(['employees' => $employees]);
    }

    /**
     * Almacenar un nuevo empleado.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|in:cajero,administrador,cocinero,mensajero',
            'identification_number' => 'required|string|max:20',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        $employee = Employee::create($validated);

        return response()->json(['employee' => $employee], 201);
    }

    /**
     * Mostrar un empleado específico.
     */
    public function show(string $id)
    {
        $employee = Employee::with('user')->find($id);

        if (!$employee) {
            return response()->json(['error' => 'Empleado no encontrado.'], 404);
        }

        return response()->json(['employee' => $employee]);
    }

    /**
     * Actualizar un empleado existente.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Empleado no encontrado.'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|in:cajero,administrador,cocinero,mensajero',
            'identification_number' => 'required|string|max:20',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        $employee->update($validated);

        return response()->json(['employee' => $employee]);
    }

    /**
     * Eliminar un empleado.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'Empleado eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'No se pudo eliminar el empleado.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}