<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: views/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <!-- Agregar el CDN de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./assets/clipboard-check.svg" type="image/x-icon">

</head>

<body class="bg-light d-flex flex-column" style="min-height: 100vh;">

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-green">
        <div class="container-fluid">

            <a class="navbar-brand" href="./index.php">
                <i class="bi bi-clipboard-check fs-2 me-3 fw-2"></i>Gestor de Tareas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Inicio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-4">Bienvenido al Gestor de Tareas</h2>
                        <p class="card-text mb-4">Gestiona tus tareas de manera eficiente. Inicia sesión para comenzar o regístrate si no tienes una cuenta.</p>
                        <div class="d-grid gap-2">
                            <a href="views/login.php" class="btn btn-primary btn-lg btn-green">Iniciar Sesión</a>
                            <a href="views/register.php" class="btn btn-outline-secondary btn-lg">Registrarse</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2025 ALR Gestor de Tareas. Todos los derechos reservados.</p>
    </footer>

    <!-- Agregar el CDN de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>