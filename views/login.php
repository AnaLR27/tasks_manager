<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas - Iniciar Sesión</title>
    <!-- Agregar el CDN de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/clipboard-check.svg" type="image/x-icon">
</head>

<body class="bg-light d-flex flex-column" style="min-height: 100vh;">

 <!-- Barra de navegación -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-green">
        <div class="container-fluid">

            <a class="navbar-brand" href="../index.php">
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
            <!-- Usamos col-md-6 y col-lg-4 para pantallas más grandes -->
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>
                    <form action="../controllers/AuthController.php?action=login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-green btn-lg">Iniciar Sesión</button>
                        </div>
                    </form>

                    <!-- Enlace para registrarse -->
                    <div class="text-center mt-3">
                        <p><small>¿Aún no tienes cuenta? <a href="../views/register.php" class="text-decoration-none a-green">Regístrate</a></small></p>
                    </div>


                    <!-- Mostrar el mensaje de error si existe -->
                    <?php if (isset($_SESSION['login_error'])): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $_SESSION['login_error']; ?>
                        </div>
                        <?php unset($_SESSION['login_error']); // Eliminar el mensaje después de mostrarlo 
                        ?>
                    <?php endif; ?>
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