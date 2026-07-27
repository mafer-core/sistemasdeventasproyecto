<?php
class Venta {
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
        $sql = "SELECT v.idventa, c.nombre as cliente, v.fecha, v.total, v.tipo_pago 
                FROM ventas v 
                INNER JOIN clientes c ON v.idcliente = c.idcliente 
                ORDER BY v.idventa DESC";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para registrar una venta completa con su detalle y descontar stock
    public function registrarVenta($idcliente, $tipo_pago, $total, $carrito){
        try {
            // Iniciamos transacción para proteger los datos
            $this->con->beginTransaction();

            // 1. Insertar la Cabecera de la Venta
            $sqlVenta = "INSERT INTO ventas (idcliente, total, tipo_pago) VALUES (:idcliente, :total, :tipo_pago)";
            $stmtVenta = $this->con->prepare($sqlVenta);
            $stmtVenta->bindParam(':idcliente', $idcliente);
            $stmtVenta->bindParam(':total', $total);
            $stmtVenta->bindParam(':tipo_pago', $tipo_pago);
            $stmtVenta->execute();

            // Obtener el ID de la venta recién creada
            $idventa = $this->con->lastInsertId();

            // 2. Insertar cada producto en el Detalle y actualizar Stock
            foreach ($carrito as $item) {
                $idproducto = $item['idproducto'];
                $cantidad = $item['cantidad'];
                $precio = $item['precio'];
                $subtotal = $cantidad * $precio;

                // Insertar detalle
                $sqlDetalle = "INSERT INTO detalle_ventas (idventa, idproducto, cantidad, precio_unitario, subtotal) 
                               VALUES (:idventa, :idproducto, :cantidad, :precio, :subtotal)";
                $stmtDetalle = $this->con->prepare($sqlDetalle);
                $stmtDetalle->bindParam(':idventa', $idventa);
                $stmtDetalle->bindParam(':idproducto', $idproducto);
                $stmtDetalle->bindParam(':cantidad', $cantidad);
                $stmtDetalle->bindParam(':precio', $precio);
                $stmtDetalle->bindParam(':subtotal', $subtotal);
                $stmtDetalle->execute();

                // Actualizar (descontar) stock del producto
                $sqlStock = "UPDATE productos SET stock = stock - :cantidad WHERE idproducto = :idproducto";
                $stmtStock = $this->con->prepare($sqlStock);
                $stmtStock->bindParam(':cantidad', $cantidad);
                $stmtStock->bindParam(':idproducto', $idproducto);
                $stmtStock->execute();
            }

            // Confirmar transacción
            $this->con->commit();
            return true;

        } catch (Exception $e) {
            // Si algo falla, revertimos todo
            $this->con->rollBack();
            return false;
        }
    }
}
?>