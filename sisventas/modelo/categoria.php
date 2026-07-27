<?php
class Categoria {

    private $idcategoria;
    private $nombre;
    private $descripcion;
    private $con;

    public function __construct(){
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=sisventas;charset=utf8", "root", "");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function listado(){
        $sql = "select * from categorias";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id){
        $sql = "select * from categorias where idcategoria = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($resultado) {
            $this->idcategoria = $resultado['idcategoria'];
            $this->nombre = $resultado['nombre'];
            $this->descripcion = $resultado['descripcion'];
        }
        return $resultado;
    }

    public function create(){
        $sql = "insert into categorias (nombre, descripcion) values (:nombre, :descripcion)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        return $stmt->execute();
    }
    
    public function update(){
        $sql = "update categorias set nombre = :nombre, descripcion = :descripcion where idcategoria = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':id', $this->idcategoria);
        return $stmt->execute();
    }

    public function delete(){
        $sql = "delete from categorias where idcategoria = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->idcategoria);
        return $stmt->execute();
    }

    // Setters y Getters
    public function setIdcategoria($id){ $this->idcategoria = $id; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setDescripcion($descripcion){ $this->descripcion = $descripcion; }

    public function getIdcategoria(){ return $this->idcategoria; }
    public function getNombre(){ return $this->nombre; }
    public function getDescripcion(){ return $this->descripcion; }
}
?>