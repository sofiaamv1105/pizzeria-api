<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Empleado</title>
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
      <h1>Editar Empleado</h1>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif

      <form action="{{ route('employees.update', $employee) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="user_id" class="form-label">Usuario</label>
          <select name="user_id" class="form-control" required>
            @foreach ($users as $user)
              <option value="{{ $user->id }}" {{ $employee->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="position" class="form-label">Posición</label>
          <select name="position" class="form-control" required>
            @foreach (['cajero', 'administrador', 'cocinero', 'mensajero'] as $pos)
              <option value="{{ $pos }}" {{ $employee->position == $pos ? 'selected' : '' }}>{{ ucfirst($pos) }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="identification_number" class="form-label">Cédula</label>
          <input type="text" name="identification_number" class="form-control" value="{{ $employee->identification_number }}" required>
        </div>

        <div class="mb-3">
          <label for="salary" class="form-label">Salario</label>
          <input type="number" name="salary" class="form-control" step="0.01" value="{{ $employee->salary }}" required>
        </div>

        <div class="mb-3">
          <label for="hire_date" class="form-label">Fecha de Contratación</label>
          <input type="date" name="hire_date" class="form-control" value="{{ $employee->hire_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </body>
</html>
