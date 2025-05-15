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
<h1>Editar Compra</h1>
<form method="POST" action="{{ route('purchases.update', $purchase->id) }}">
    @csrf
    @method('PUT')
  <div class="mb-3">
    <label for="supplier_id" class="form-label">Proveedor</label>
    <select name="supplier_id" class="form-control" required>
      @foreach($suppliers as $supplier)
        <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
          {{ $supplier->name }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="raw_material_id" class="form-label">Material</label>
    <select name="raw_material_id" class="form-control" required>
      @foreach($rawMaterials as $material)
        <option value="{{ $material->id }}" {{ $purchase->raw_material_id == $material->id ? 'selected' : '' }}>
          {{ $material->name }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="quantity" class="form-label">Cantidad</label>
    <input type="number" step="0.01" name="quantity" class="form-control" value="{{ $purchase->quantity }}" required>
  </div>

  <div class="mb-3">
    <label for="purchase_price" class="form-label">Precio</label>
    <input type="number" step="0.01" name="purchase_price" class="form-control" value="{{ $purchase->purchase_price }}" required>
  </div>

  <div class="mb-3">
    <label for="purchase_date" class="form-label">Fecha</label>
    <input type="datetime-local" name="purchase_date" class="form-control" value="{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('Y-m-d\TH:i') }}" required>
  </div>

  <button type="submit" class="btn btn-primary">Actualizar</button>
  <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
