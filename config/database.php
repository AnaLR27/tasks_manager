<?php
class Database
{
    private static $instance = null;
    private $conn;
    // Variables para las credenciales de la base de datos
    private $host = "localhost";
    private $dbname = "gestor_tareas";
    private $username = "root";
    private $password = "";


    private function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
