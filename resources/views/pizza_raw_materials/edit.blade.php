<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Relación Pizza - Materia Prima</title>
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
      <h1>Editar Materia Prima de Pizzas</h1>
      <form method="POST" action="{{ route('pizza_raw_materials.update', $pizzaRawMaterial->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="pizza_id" class="form-label">Pizza</label>
          <select class="form-select" name="pizza_id" required>
            @foreach($pizzas as $pizza)
              <option value="{{ $pizza->id }}" {{ $pizzaRawMaterial->pizza_id == $pizza->id ? 'selected' : '' }}>
                {{ $pizza->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="raw_material_id" class="form-label">Materia Prima</label>
          <select class="form-select" name="raw_material_id" required>
            @foreach($rawMaterials as $material)
              <option value="{{ $material->id }}" {{ $pizzaRawMaterial->raw_material_id == $material->id ? 'selected' : '' }}>
                {{ $material->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="quantity" class="form-label">Cantidad</label>
          <input type="number" step="0.01" class="form-control" name="quantity" value="{{ old('quantity', $pizzaRawMaterial->quantity) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('pizza_raw_materials.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </body>
</html>