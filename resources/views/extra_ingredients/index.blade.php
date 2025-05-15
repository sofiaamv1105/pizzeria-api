<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Listado de Ingredientes Extra</title>
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
  <h1>Listado de Ingredientes Extra</h1>
  <a href="{{ route('extra_ingredients.create') }}" class="btn btn-success mb-3">Agregar</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($extraIngredients as $ingredient)
        <tr>
          <td>{{ $ingredient->id }}</td>
          <td>{{ $ingredient->name }}</td>
          <td>${{ number_format($ingredient->price, 2) }}</td>
          <td>
            <a href="{{ route('extra_ingredients.edit', $ingredient->id) }}" class="btn btn-info">Editar</a>
            <form action="{{ route('extra_ingredients.destroy', $ingredient->id) }}" method="POST" style="display:inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</body>
</html>