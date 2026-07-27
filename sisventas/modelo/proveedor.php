<?php
class Proveedor {

    private $idproveedor;
    private $nombre;
    private $ruc;
    private $telefono;
    private $direccion;
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
        $sql = "select * from proveedores";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id){
        $sql = "select * from proveedores where idproveedor = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($resultado) {
            $this->idproveedor = $resultado['idproveedor'];
            $this->nombre = $resultado['nombre'];
            $this->ruc = $resultado['ruc'];
            $this->telefono = $resultado['telefono'];
            $this->direccion = $resultado['direccion'];
        }
        return $resultado;
    }

    public function create(){
        $sql = "insert into proveedores (nombre, ruc, telefono, direccion)
                values (:nombre, :ruc, :telefono, :direccion)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':ruc', $this->ruc);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':direccion', $this->direccion);
        
        return $stmt->execute();
    }
    
    public function update(){
        $sql = "update proveedores set 
                nombre = :nombre, 
                ruc = :ruc, 
                telefono = :telefono, 
                direccion = :direccion 
                where idproveedor = :id";
                
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':ruc', $this->ruc);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':id', $this->idproveedor);
        
        return $stmt->execute();
    }

    public function delete(){
        $sql = "delete from proveedores where idproveedor = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->idproveedor);
        
        return $stmt->execute();
    }

    // Métodos Setters y Getters
    public function setIdproveedor($id){ $this->idproveedor = $id; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setRuc($ruc){ $this->ruc = $ruc; }
    public function setTelefono($telefono){ $this->telefono = $telefono; }
    public function setDireccion($direccion){ $this->direccion = $direccion; }

    public function getIdproveedor(){ return $this->idproveedor; }
    public function getNombre(){ return $this->nombre; }
    public function getRuc(){ return $this->ruc; }
    public function getTelefono(){ return $this->telefono; }
    public function getDireccion(){ return $this->direccion; }
}
?>