<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Compras</title>
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
      <h1>Listado de Compras</h1>
      <a href="{{ route('purchases.create') }}" class="btn btn-success mb-3">Agregar Compra</a>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Proveedor</th>
            <th>Material</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($purchases as $purchase)
          <tr>
            <td>{{ $purchase->id }}</td>
            <td>{{ $purchase->supplier->name }}</td>
            <td>{{ $purchase->rawMaterial->name }}</td>
            <td>{{ $purchase->quantity }}</td>
            <td>${{ $purchase->purchase_price }}</td>
            <td>{{ $purchase->purchase_date }}</td>
            <td>
              <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-info btn-sm">Editar</a>
              <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
