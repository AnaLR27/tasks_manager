<?php
require_once "../models/Task.php";
require_once __DIR__ . "/../controllers/TaskController.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$tarea = new TaskController();
$tasks = $tarea->getTasks(); // Ya no pasamos user_id

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas - Gestor de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/clipboard-check.svg" type="image/x-icon">
</head>

<body class="bg-light d-flex flex-column" style="min-height: 100vh;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-green mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"> <i class="bi bi-clipboard-check fs-2 me-3 fw-2"></i>Gestor de Tareas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../controllers/AuthController.php?action=logout">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container flex-grow-1 d-flex justify-content-center align-items-start mt-5">
        <div class="row justify-content-around w-100 align-items-start">
            <div class="card shadow-lg col-5 ">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Agregar tarea</h2>
                    <form action="../controllers/TaskController.php?action=createTask" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-green">Agregar Tarea</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- mostrar las tareas -->

            <div class="card shadow-lg col-5">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Mis Tareas</h2>
                    <ul class="list-group mb-4">
                        <?php if (empty($tasks)): ?>
                            <li class="list-group-item text-center text-muted">
                                No tienes tareas registradas.
                            </li>
                        <?php else: ?>
                            <?php foreach ($tasks as $task): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><?php echo htmlspecialchars($task['titulo']); ?></strong>
                                    <div>
                                        <!-- Botón Detalles -->
                                        <button class="btn btn-info btn-sm details-btn" data-id="<?php echo $task['id']; ?>"
                                            data-title="<?php echo htmlspecialchars($task['titulo']); ?>"
                                            data-description="<?php echo htmlspecialchars($task['descripcion']); ?>">
                                            Detalles
                                        </button>

                                        <!-- Botón Editar -->
                                        <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $task['id']; ?>"
                                            data-title="<?php echo htmlspecialchars($task['titulo']); ?>"
                                            data-description="<?php echo htmlspecialchars($task['descripcion']); ?>">
                                            Editar
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <form action="../controllers/TaskController.php?action=deleteTask" method="POST" class="d-inline">
                                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>


                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 ALR Gestor de Tareas. Todos los derechos reservados.</p>
    </footer>

    <!-- Modal para editar tarea -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Editar Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm" action="../controllers/TaskController.php?action=updateTask" method="POST">
                        <input type="hidden" name="task_id" id="editTaskId">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Título</label>
                            <input type="text" id="editTitle" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Descripción</label>
                            <textarea id="editDescription" name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para detalles de la tarea -->
    <div class="modal fade" id="taskDetailsModal" tabindex="-1" aria-labelledby="taskDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskDetailsModalLabel">Detalles de la Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="detailsTitle"></h5>
                    <p id="detailsDescription" class="text-muted"></p>
                </div>
            </div>
        </div>
    </div>



    <!-- JS para controlar las modales-->
    <script src="../assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>