<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Editar Ingrediente de Pizza</title>
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
  <h1>Editar Ingrediente de Pizza</h1>
  <form method="POST" action="{{ route('pizza_ingredients.update', $pizzaIngredient->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="pizza_id" class="form-label">Pizza</label>
      <select name="pizza_id" class="form-select" required>
        @foreach ($pizzas as $pizza)
          <option value="{{ $pizza->id }}" {{ $pizzaIngredient->pizza_id == $pizza->id ? 'selected' : '' }}>{{ $pizza->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="ingredient_id" class="form-label">Ingrediente</label>
      <select name="ingredient_id" class="form-select" required>
        @foreach ($ingredients as $ingredient)
          <option value="{{ $ingredient->id }}" {{ $pizzaIngredient->ingredient_id == $ingredient->id ? 'selected' : '' }}>{{ $ingredient->name }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
  </form>
</div>
</body>
</html>
