<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Pedido</title>
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
      <h1>{{ isset($order) ? 'Editar Pedido' : 'Crear Pedido' }}</h1>
      <form action="{{ isset($order) ? route('orders.update', $order->id) : route('orders.store') }}" method="POST">
        @csrf
        @if(isset($order))
          @method('PUT')
        @endif

        <div class="mb-3">
          <label class="form-label">Cliente</label>
          <select name="client_id" class="form-control">
            @foreach ($clients as $client)
              <option value="{{ $client->id }}" {{ isset($order) && $order->client_id == $client->id ? 'selected' : '' }}>
                {{ $client->user->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Sucursal</label>
          <select name="branch_id" class="form-control">
            @foreach ($branches as $branch)
              <option value="{{ $branch->id }}" {{ isset($order) && $order->branch_id == $branch->id ? 'selected' : '' }}>
                {{ $branch->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Repartidor (opcional)</label>
          <select name="delivery_person_id" class="form-control">
            <option value="">Sin asignar</option>
            @foreach ($employees as $employee)
              <option value="{{ $employee->id }}" {{ isset($order) && $order->delivery_person_id == $employee->id ? 'selected' : '' }}>
                {{ $employee->user->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Precio Total</label>
          <input type="number" name="total_price" step="0.01" class="form-control" value="{{ old('total_price', $order->total_price ?? '') }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Estado</label>
          <select name="status" class="form-control">
            @foreach (['pendiente', 'en preparacion', 'listo', 'entregado'] as $status)
              <option value="{{ $status }}" {{ isset($order) && $order->status == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Tipo de Entrega</label>
          <select name="delivery_type" class="form-control">
            <option value="en_local" {{ isset($order) && $order->delivery_type == 'en local' ? 'selected' : '' }}>En local</option>
            <option value="a_domicilio" {{ isset($order) && $order->delivery_type == 'a domicilio' ? 'selected' : '' }}>A domicilio</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($order) ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </body>
</html>