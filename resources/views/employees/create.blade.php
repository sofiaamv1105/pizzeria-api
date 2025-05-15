<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Empleado</title>
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
      <h1>Crear Empleado</h1>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif

      <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="user_id" class="form-label">Usuario</label>
          <select name="user_id" class="form-control" required>
            @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="position" class="form-label">Posición</label>
          <select name="position" class="form-control" required>
            <option value="cajero">Cajero</option>
            <option value="administrador">Administrador</option>
            <option value="cocinero">Cocinero</option>
            <option value="mensajero">Mensajero</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="identification_number" class="form-label">Cédula</label>
          <input type="text" name="identification_number" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="salary" class="form-label">Salario</label>
          <input type="number" name="salary" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
          <label for="hire_date" class="form-label">Fecha de Contratación</label>
          <input type="date" name="hire_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </body>
</html>
