<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de Pizzas por Pedido</title>
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
      <h1>Listado de Pizzas por Pedido</h1>
      <a href="{{ route('order_pizzas.create') }}" class="btn btn-success mb-3">Agregar</a>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Pedido</th>
            <th>Tamaño de Pizza</th>
            <th>Cantidad</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orderPizzas as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->order->id }}</td>
            <td>{{ $item->pizzaSize->size }} (${{ $item->pizzaSize->price }})</td>
            <td>{{ $item->quantity }}</td>
            <td>
              <a href="{{ route('order_pizzas.edit', $item->id) }}" class="btn btn-info">Editar</a>
              <form action="{{ route('order_pizzas.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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