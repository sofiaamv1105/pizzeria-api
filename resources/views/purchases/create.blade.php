<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Compra</title>
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
      <h1>Registrar Compra</h1>
      <form action="{{ route('purchases.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="supplier_id" class="form-label">Proveedor</label>
          <select name="supplier_id" id="supplier_id" class="form-control" required>
            @foreach($suppliers as $supplier)
              <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="raw_material_id" class="form-label">Material</label>
          <select name="raw_material_id" id="raw_material_id" class="form-control" required>
            @foreach($rawMaterials as $material)
              <option value="{{ $material->id }}">{{ $material->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="quantity" class="form-label">Cantidad</label>
          <input type="number" step="0.01" name="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="purchase_price" class="form-label">Precio</label>
          <input type="number" step="0.01" name="purchase_price" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="purchase_date" class="form-label">Fecha</label>
          <input type="datetime-local" name="purchase_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Cancelar</a>
      </form>
    </div>
  </body>
</html>
