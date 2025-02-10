<?php
require_once __DIR__ . "/../config/database.php";

class Task
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function createTask($userId, $titulo, $descripcion)
    {
        // 1. Insertar tarea en la tabla 'tarea'
        $query = "INSERT INTO tarea (titulo, descripcion) VALUES (:titulo, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descripcion", $descripcion);

        // Ejecutar la consulta para insertar la tarea
        if ($stmt->execute()) {
            // 2. Obtener el ID de la tarea recién insertada
            $lastInsertId = $this->db->lastInsertId();
            // 3. Insertar en la tabla 'usuarios_tarea' para asignar la tarea al usuario
            $query = "INSERT INTO usuarios_tarea (tarea, usuario) VALUES (:tarea_id, :usuario_id)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":tarea_id", $lastInsertId);
            $stmt->bindParam(":usuario_id", $userId);
            // Ejecutar la consulta para asignar la tarea
            if ($stmt->execute()) {
                return $lastInsertId; // Retornar el ID de la tarea creada
            } else {
                // Si la inserción en 'usuarios_tarea' falla, eliminar la tarea insertada
                $deleteQuery = "DELETE FROM tarea WHERE id = :tarea_id";
                $deleteStmt = $this->db->prepare($deleteQuery);
                $deleteStmt->bindParam(":tarea_id", $lastInsertId);
                $deleteStmt->execute();

                return false; // Retornar false si algo falla
            }
        }

        return false; // Retornar false si la inserción de la tarea falla
    }
    public function getTasks($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM tarea inner JOIN usuarios_tarea ON tarea.id=usuarios_tarea.tarea WHERE usuarios_tarea.usuario = ?;");

        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    public function updateTask($taskId, $title, $description)
    {
        $sql = "UPDATE tarea SET titulo = :title, descripcion = :description WHERE id = :task_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':task_id' => $taskId
        ]);
    }


    public function deleteTask($taskId)
    {
        $stmt = $this->db->prepare("DELETE FROM tarea WHERE id = ?");
        return $stmt->execute([$taskId]);
    }
}
