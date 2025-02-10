<?php
require_once __DIR__ . "/../models/User.php";
session_start();

class AuthController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->userModel->register($username, $password)) {
                header("Location: ../index.php");
                exit;
            } else {
                // Almacenar el mensaje de error en la sesión
                $_SESSION['login_error'] = "Usuario ya existente";
                header("Location: ../views/register.php");
                exit;
            }
        }
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: ../views/dashboard.php");
                exit;
            } else {
                // Almacenar el mensaje de error en la sesión
                $_SESSION['login_error'] = "Usuario o contraseña incorrectos";
                header("Location: ../views/login.php");
                exit;
            }
        }
    }

    // Maneja el logout
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: ../views/login.php");
        exit();
    }
}

$authController = new AuthController();
if (isset($_GET['action']) && $_GET['action'] == 'register') {
    $authController->register();
} elseif (isset($_GET['action']) && $_GET['action'] == 'login') {
    $authController->login();
} elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $authController->logout();
}
