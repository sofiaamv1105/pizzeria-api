<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Agregar Pizza a Pedido</title>
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
    <div class="container">
      <h1>Agregar Pizza a Pedido</h1>
      <form action="{{ route('order_pizzas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="order_id" class="form-label">Pedido</label>
          <select name="order_id" class="form-select" required>
            @foreach($orders as $order)
              <option value="{{ $order->id }}">{{ $order->id }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="pizza_size_id" class="form-label">Tamaño de Pizza</label>
          <select name="pizza_size_id" class="form-select" required>
            @foreach($pizzaSizes as $size)
              <option value="{{ $size->id }}">{{ $size->size }} (${{ $size->price }})</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="quantity" class="form-label">Cantidad</label>
          <input type="number" name="quantity" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('order_pizzas.index') }}" class="btn btn-secondary">Volver</a>
      </form>
    </div>
  </body>
</html>
