<?php
class DBConexion { // O DBConection, fíjate bien en las letras
    private $host = "localhost";
    private $db = "sisventas"; 
    private $user = "root";
    private $password = "";

    public function conectar() {
        try {
            $conexion = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user, $this->password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }
}
?>