@if (!Auth::check())
    <script>window.location.href = "{{ route('login') }}";</script>
@endif
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Pizzas</title>
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
    @if (!Auth::check())
      <script>window.location.href = "{{ route('login') }}";</script>
    @endif

    <div class="container mt-4">
      <h1 class="mb-4">Listado de Pizzas</h1>
      
      <a href="{{ route('pizzas.create') }}" class="btn btn-primary mb-3">Agregar Nueva Pizza</a>

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pizzas as $pizza)
            <tr>
              <td>{{ $pizza->id }}</td>
              <td>{{ $pizza->name }}</td>
              <td>
                <a href="{{ route('pizzas.edit', $pizza->id) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('pizzas.destroy', $pizza->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta pizza?')">Eliminar</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
