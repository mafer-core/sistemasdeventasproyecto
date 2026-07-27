<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


$idventa = isset($_GET['id']) ? $_GET['id'] : 0;
$objVenta = new Venta();

$venta = $objVenta->obtenerVenta($idventa);
$detalle = $objVenta->obtenerDetalleVenta($idventa);

if (!$venta) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Venta no encontrada.</div></div>";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php";
    exit();
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas id-card"></i> Detalle de la Venta #<?php echo $venta['idventa']; ?></h5>
                    <a href="listado.php" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> <?php echo $venta['cliente']; ?></p>
                            <p><strong>DNI/RUC:</strong> <?php echo $venta['dni']; ?></p>
                            <p><strong>Teléfono:</strong> <?php echo $venta['telefono']; ?></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p><strong>Fecha:</strong> <?php echo $venta['fecha']; ?></p>
                            <p><strong>Tipo de Pago:</strong> 
                                <span class="badge bg-<?php echo ($venta['tipo_pago'] == 'Contado') ? 'success' : 'info'; ?>">
                                    <?php echo $venta['tipo_pago']; ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <h6 class="text-primary mb-3"><i class="fas fa-box-open"></i> Productos Comprados</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detalle as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['nomproducto']; ?></td>
                                        <td>$<?php echo number_format($item['precio_unitario'], 2); ?></td>
                                        <td><?php echo $item['cantidad']; ?></td>
                                        <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        <h4 class="text-success">Total Pagado: $<?php echo number_format($venta['total'], 2); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>