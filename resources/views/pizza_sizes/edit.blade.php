<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Tamaño de Pizza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <h1 class="mb-4">Editar Tamaño de Pizza</h1>

      <form method="POST" action="{{ route('pizza_sizes.update', $pizzaSize) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="pizza_id" class="form-label">Pizza:</label>
          <select name="pizza_id" id="pizza_id" class="form-select" required>
            @foreach ($pizzas as $pizza)
              <option value="{{ $pizza->id }}" {{ $pizzaSize->pizza_id == $pizza->id ? 'selected' : '' }}>
                {{ $pizza->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="size" class="form-label">Tamaño:</label>
          <select name="size" id="size" class="form-select" required>
            @foreach (['pequeña', 'mediana', 'grande'] as $option)
              <option value="{{ $option }}" {{ $pizzaSize->size == $option ? 'selected' : '' }}>
                {{ ucfirst($option) }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Precio:</label>
          <input type="number" name="price" id="price" step="0.01" value="{{ $pizzaSize->price }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('pizza_sizes.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </body>
</html>