<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/modelo/venta.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcliente   = $_POST['idcliente'] ?? '';
    $idcondicion = $_POST['idcondicion'] ?? $_POST['tipo_pago'] ?? '01'; // Adaptado a CondicionVenta
    $total       = floatval($_POST['total_venta'] ?? 0);
    $detalle_json = $_POST['detalle_json'] ?? '[]';

    $carrito = json_decode($detalle_json, true);

    if (!empty($carrito) && $total > 0 && !empty($idcliente)) {
        
        // 1. Desglosamos el Total en Valor Venta e IGV (18%)
        $valorventa = round($total / 1.18, 2);
        $igv        = round($total - $valorventa, 2);

        $objVenta = new Venta();
        
        // 2. Enviamos los parámetros acordes a la tabla Facturas
        $resultado = $objVenta->registrarVenta($idcliente, $idcondicion, $valorventa, $igv, $carrito);

        if ($resultado) {
            header("Location: listado.php?status=success");
            exit();
        } else {
            echo "<script>
                    alert('Error al registrar la venta. Verifique el stock o la conexión.');
                    window.history.back();
                  </script>";
            exit();
        }
    } else {
        header("Location: crear.php?error=empty");
        exit();
    }
} else {
    header("Location: crear.php");
    exit();
}
?>