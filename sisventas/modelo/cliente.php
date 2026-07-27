<?php
class Cliente {

    private $idcliente;
    private $nombre;
    private $dni;
    private $telefono;
    private $direccion;
    private $con;

    public function __construct(){
        // Conexión directa con PDO
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=sisventas;charset=utf8", "root", "");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function listado(){
        $sql = "select * from clientes";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id){
        $sql = "select * from clientes where idcliente = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($resultado) {
            $this->idcliente = $resultado['idcliente'];
            $this->nombre = $resultado['nombre'];
            $this->dni = $resultado['dni'];
            $this->telefono = $resultado['telefono'];
            $this->direccion = $resultado['direccion'];
        }
        return $resultado;
    }

    public function create(){
        $sql = "insert into clientes (nombre, dni, telefono, direccion)
                values (:nombre, :dni, :telefono, :direccion)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':dni', $this->dni);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':direccion', $this->direccion);
        
        return $stmt->execute();
    }
    
    public function update(){
        $sql = "update clientes set 
                nombre = :nombre, 
                dni = :dni, 
                telefono = :telefono, 
                direccion = :direccion 
                where idcliente = :id";
                
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':dni', $this->dni);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':id', $this->idcliente);
        
        return $stmt->execute();
    }

    public function delete(){
        $sql = "delete from clientes where idcliente = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->idcliente);
        
        return $stmt->execute();
    }

    // Métodos Setters y Getters
    public function setIdcliente($id){ $this->idcliente = $id; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setDni($dni){ $this->dni = $dni; }
    public function setTelefono($telefono){ $this->telefono = $telefono; }
    public function setDireccion($direccion){ $this->direccion = $direccion; }

    public function getIdcliente(){ return $this->idcliente; }
    public function getNombre(){ return $this->nombre; }
    public function getDni(){ return $this->dni; }
    public function getTelefono(){ return $this->telefono; }
    public function getDireccion(){ return $this->direccion; }
}
?>