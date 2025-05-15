<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pizza - Ingredientes</title>
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
    <h1>Pizza - Ingredientes</h1>
    <a href="{{ route('pizza_ingredients.create') }}" class="btn btn-success mb-3">Agregar</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pizza</th>
                <th>Ingrediente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pizzaIngredients as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->pizza->name ?? 'N/A' }}</td>
                    <td>{{ $item->ingredient->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('pizza_ingredients.edit', $item->id) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('pizza_ingredients.destroy', $item->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
