<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de Empleados</title>
  </head>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Menu Principal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm" type="submit">Cerrar sesión</button>
          </form>
        </li>
      </ul>
    </div>
</nav>
  <body>
    <div class="container mt-4">
      <h1>Listado de Empleados</h1>
      <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">Agregar Empleado</a>

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre Usuario</th>
            <th>Posición</th>
            <th>Cédula</th>
            <th>Salario</th>
            <th>Fecha Contratación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($employees as $employee)
            <tr>
              <td>{{ $employee->id }}</td>
              <td>{{ $employee->user->name }}</td>
              <td>{{ ucfirst($employee->position) }}</td>
              <td>{{ $employee->identification_number }}</td>
              <td>${{ $employee->salary }}</td>
              <td>{{ $employee->hire_date }}</td>
              <td>
                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-info btn-sm">Editar</a>
                <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline-block">
                  @csrf
                  @method('DELETE')
                  <input class="btn btn-danger btn-sm" type="submit" value="Eliminar" onclick="return confirm('¿Estás seguro?')">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
