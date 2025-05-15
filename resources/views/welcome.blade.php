<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pizzería El Buen Sabor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
      rel="stylesheet"
    >
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg-cover {
            background-image: url('/images/pizza_fondo.jpg');
            background-size: cover;
            background-position: center;
            height: 100%;
            color: white;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.6); /* oscurece un poco para que se lea mejor */
            height: 100%;
        }
    </style>
</head>
<body>

<div class="bg-cover">
    <div class="overlay d-flex flex-column justify-content-center align-items-center text-center px-4">
        <h1 class="display-3 fw-bold">🍕 El Buen Sabor</h1>
        <p class="lead">La mejor pizza artesanal, ¡directo a tu mesa!</p>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg me-2">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-danger btn-lg">Registrarse</a>
        </div>
    </div>
</div>

</body>
</html>