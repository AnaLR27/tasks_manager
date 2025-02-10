<?php
require_once __DIR__ . "/../config/database.php";
class User
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function verificarSiExiste($usuario)
    {
        $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();

        // Verificar si se obtuvo un resultado
        if ($stmt->rowCount() > 0) {
            // Si se encuentra el usuario, devuelve el usuario encontrado
            return true;
        } else {
            // Si no se encuentra el usuario, devolver false
            return false;
        }
    }

    public function register($usuario, $password)
    {
        if ($this->verificarSiExiste($usuario)) {
            return false; // Si el usuario ya existe, no crear el nuevo
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
            return $stmt->execute([$usuario, $hashedPassword]);
        }
    }
    public function login($usuario, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
