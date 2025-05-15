<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Ingrediente Extra del Pedido</title>
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
      <h1>Editar Ingrediente Extra del Pedido</h1>
      <form action="{{ route('order_extra_ingredients.update', $orderExtraIngredient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="order_id" class="form-label">Pedido</label>
          <select name="order_id" id="order_id" class="form-control">
            @foreach ($orders as $order)
              <option value="{{ $order->id }}" {{ $order->id == $orderExtraIngredient->order_id ? 'selected' : '' }}>
                {{ $order->id }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="extra_ingredient_id" class="form-label">Ingrediente Extra</label>
          <select name="extra_ingredient_id" id="extra_ingredient_id" class="form-control">
            @foreach ($extraIngredients as $ingredient)
              <option value="{{ $ingredient->id }}" {{ $ingredient->id == $orderExtraIngredient->extra_ingredient_id ? 'selected' : '' }}>
                {{ $ingredient->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="quantity" class="form-label">Cantidad</label>
          <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $orderExtraIngredient->quantity }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('order_extra_ingredients.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </body>
</html>