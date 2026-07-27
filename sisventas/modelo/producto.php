<?php

class Producto {

    private $idproducto;
    private $nomprodu;
    private $unimed;
    private $stock;
    private $preuni;
    private $cosuni;
    private $con;

    public function __construct(){
        // Conexión directa integrada para evitar problemas de rutas
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=sisventas;charset=utf8", "root", "");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function listado(){
        $sql = "select * from productos";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultados;
    }

    public function buscar($id){
        $sql = "select * from productos where idproducto = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($resultado) {
            $this->idproducto = $resultado['idproducto'];
            $this->nomprodu   = $resultado['nomprodu'];
            $this->unimed     = $resultado['unimed'];
            $this->stock      = $resultado['stock'];
            $this->preuni     = $resultado['preuni'];
            $this->cosuni     = $resultado['cosuni'];
        }
        return $resultado;
    }

    public function create(){
        $sql = "insert into productos (nomproducto, unimed, stock, preuni, cosuni)
                values (:nompro, :unimed, :stock, :preuni, :cosuni)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nompro', $this->nomprodu);
        $stmt->bindParam(':unimed', $this->unimed);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':preuni', $this->preuni);
        $stmt->bindParam(':cosuni', $this->cosuni);
        
        return $stmt->execute();
    }
    
    public function update(){
        $sql = "update productos set 
                nomproducto = :nompro, 
                unimed = :unimed, 
                stock = :stock, 
                preuni = :preuni, 
                cosuni = :cosuni 
                where idproducto = :id";
                
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nompro', $this->nomprodu);
        $stmt->bindParam(':unimed', $this->unimed);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':preuni', $this->preuni);
        $stmt->bindParam(':cosuni', $this->cosuni);
        $stmt->bindParam(':id', $this->idproducto);
        
        return $stmt->execute();
    }

    public function delete(){
        $sql = "delete from productos where idproducto = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->idproducto);
        
        return $stmt->execute();
    }

    // Métodos Setters y Getters
    public function setNomprodu($nom){ $this->nomprodu = $nom; }
    public function setUnimed($und){ $this->unimed = $und; }
    public function setStock($stk){ $this->stock = $stk; }
    public function setPreuni($pre){ $this->preuni = $pre; }
    public function setCosuni($cos){ $this->cosuni = $cos; }
    public function setIdproducto($id){ $this->idproducto = $id; }

    public function getIdproducto(){ return $this->idproducto; }
    public function getNomprodu(){ return $this->nomprodu; }
    public function getUnimed(){ return $this->unimed; }
    public function getStock(){ return $this->stock; }
    public function getPreuni(){ return $this->preuni; }
    public function getCosuni(){ return $this->cosuni; }
}
?>