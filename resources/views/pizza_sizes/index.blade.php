<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tamaños de Pizza</title>
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
      <h1 class="mb-4">Tamaños de Pizza</h1>

      <a href="{{ route('pizza_sizes.create') }}" class="btn btn-primary mb-3">Agregar tamaño</a>

      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Pizza</th>
            <th>Tamaño</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pizzaSizes as $size)
            <tr>
              <td>{{ $size->pizza->name }}</td>
              <td>{{ ucfirst($size->size) }}</td>
              <td>${{ number_format($size->price, 2) }}</td>
              <td>
                <a href="{{ route('pizza_sizes.edit', $size) }}" class="btn btn-sm btn-warning">Editar</a>

                <form action="{{ route('pizza_sizes.destroy', $size) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>