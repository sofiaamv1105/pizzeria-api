<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de Pedidos</title>
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
      <h1>Listado de Pedidos</h1>
      <a href="{{ route('orders.create') }}" class="btn btn-success mb-3">Agregar Pedido</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Sucursal</th>
            <th>Repartidor</th>
            <th>Precio Total</th>
            <th>Estado</th>
            <th>Tipo Entrega</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->client->user->name }}</td>
              <td>{{ $order->branch->name }}</td>
              <td>{{ $order->deliveryPerson->user->name ?? 'N/A' }}</td>
              <td>${{ $order->total_price }}</td>
              <td>{{ $order->status }}</td>
              <td>{{ $order->delivery_type }}</td>
              <td>
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-info btn-sm">Editar</a>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>