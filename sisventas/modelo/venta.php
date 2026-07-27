<?php
class Venta {
    private $con;

    public function __construct() {
        try {
            // Se usa la conexión PDO asignada a $this->con
            $this->con = new PDO("mysql:host=localhost;dbname=sisventas;charset=utf8", "root", "");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // 1. Obtener la cabecera de una venta por ID (Tabla Facturas)
    public function obtenerVenta($idfactura) {
        $sql = "SELECT f.*, c.nomcliente, c.ruccliente, c.telcliente, c.dircliente 
                FROM Facturas f 
                INNER JOIN Clientes c ON f.idcliente = c.idcliente 
                WHERE f.idfactura = :idfactura";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':idfactura', $idfactura);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 2. Obtener el detalle de productos (Tabla DetalleFactura)
    public function obtenerDetalleVenta($idfactura) {
        $sql = "SELECT df.*, p.nomproducto 
                FROM DetalleFactura df 
                INNER JOIN Productos p ON df.idproducto = p.idproducto 
                WHERE df.idfactura = :idfactura";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':idfactura', $idfactura);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Listado General de Ventas/Facturas
    public function listado() {
        try {
            $sql = "SELECT f.idfactura, f.fecha, c.nomcliente, f.valorventa, f.igv, (f.valorventa + f.igv) AS total 
                    FROM Facturas f 
                    INNER JOIN Clientes c ON f.idcliente = c.idcliente 
                    ORDER BY f.idfactura DESC";
                    
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en listado de ventas: " . $e->getMessage());
        }
    }

    // 4. Registrar Nueva Venta (Facturas + DetalleFactura + Descuento Stock)
    public function registrarVenta($idcliente, $idcondicion, $valorventa, $igv, $carrito) {
        try {
            $this->con->beginTransaction();

            // Insertar Cabecera
            $sqlVenta = "INSERT INTO Facturas (fecha, idcliente, idcondicion, valorventa, igv) 
                         VALUES (CURDATE(), :idcliente, :idcondicion, :valorventa, :igv)";
            $stmtVenta = $this->con->prepare($sqlVenta);
            $stmtVenta->bindParam(':idcliente', $idcliente);
            $stmtVenta->bindParam(':idcondicion', $idcondicion);
            $stmtVenta->bindParam(':valorventa', $valorventa);
            $stmtVenta->bindParam(':igv', $igv);
            $stmtVenta->execute();

            $idfactura = $this->con->lastInsertId();

            // Insertar Detalle y Actualizar Stock
            $sqlDetalle = "INSERT INTO DetalleFactura (idfactura, idproducto, cant, cosuni, preuni) 
                           VALUES (:idfactura, :idproducto, :cant, :cosuni, :preuni)";
            $stmtDetalle = $this->con->prepare($sqlDetalle);

            $sqlStock = "UPDATE Productos SET stock = stock - :cant WHERE idproducto = :idproducto";
            $stmtStock = $this->con->prepare($sqlStock);

            foreach ($carrito as $item) {
                $idproducto = $item['idproducto'];
                $cant       = $item['cantidad'] ?? $item['cant'];
                $preuni     = $item['precio'] ?? $item['preuni'];
                $cosuni     = $item['cosuni'] ?? 0;

                // Graba detalle
                $stmtDetalle->bindParam(':idfactura', $idfactura);
                $stmtDetalle->bindParam(':idproducto', $idproducto);
                $stmtDetalle->bindParam(':cant', $cant);
                $stmtDetalle->bindParam(':cosuni', $cosuni);
                $stmtDetalle->bindParam(':preuni', $preuni);
                $stmtDetalle->execute();

                // Actualiza stock
                $stmtStock->bindParam(':cant', $cant);
                $stmtStock->bindParam(':idproducto', $idproducto);
                $stmtStock->execute();
            }

            $this->con->commit();
            return true;

        } catch (Exception $e) {
            $this->con->rollBack();
            return false;
        }
    }
}
?>