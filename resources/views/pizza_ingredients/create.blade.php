<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Agregar Ingrediente a Pizza</title>
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
  <h1>Agregar Ingrediente a Pizza</h1>
  <form method="POST" action="{{ route('pizza_ingredients.store') }}">
    @csrf
    <div class="mb-3">
      <label for="pizza_id" class="form-label">Pizza</label>
      <select name="pizza_id" class="form-select" required>
        @foreach ($pizzas as $pizza)
          <option value="{{ $pizza->id }}">{{ $pizza->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="ingredient_id" class="form-label">Ingrediente</label>
      <select name="ingredient_id" class="form-select" required>
        @foreach ($ingredients as $ingredient)
          <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
</div>
</body>
</html>
