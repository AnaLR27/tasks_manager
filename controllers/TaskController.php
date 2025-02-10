<?php
require_once __DIR__ . "/../models/Task.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class TaskController
{
    private $taskModel;
    public function __construct()
    {
        $this->taskModel = new Task();
    }
    public function createTask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            if ($this->taskModel->createTask($_SESSION['user_id'], $title, $description)) {
                header("Location: ../views/dashboard.php");
                exit;
            }
        }
    }
    public function getTasks()
    {
        if (isset($_SESSION['user_id'])) {
            return $this->taskModel->getTasks($_SESSION['user_id']);
        }
        return [];
    }
    public function updateTask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id']) && isset($_POST['title'])) {
            $taskId = $_POST['task_id'];
            $title = $_POST['title'];
            $description = $_POST['description'] ?? '';

            if ($this->taskModel->updateTask($taskId, $title, $description)) {
                header("Location: ../views/dashboard.php");
                exit;
            }
        }
    }

    public function deleteTask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
            if ($this->taskModel->deleteTask($_POST['task_id'])) {
                header("Location: ../views/dashboard.php");
                exit;
            }
        }
    }
}
$taskController = new TaskController();
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'createTask') {
        $taskController->createTask();
    } elseif ($_GET['action'] == 'deleteTask') {
        $taskController->deleteTask();
    } elseif ($_GET['action'] == 'updateTask') {
        $taskController->updateTask();
    }
}
