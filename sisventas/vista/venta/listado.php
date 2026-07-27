<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/modelo/venta.php";

$objVenta = new Venta();
$ventas = $objVenta->listado();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Historial de Ventas</h5>
                    <a href="crear.php" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Nueva Venta
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>N° Factura</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Valor Venta</th>
                                    <th>IGV</th>
                                    <th>Total</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ventas)) { 
                                    foreach ($ventas as $v) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($v['idfactura'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($v['nomcliente'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($v['fecha'] ?? ''); ?></td>
                                            <td>S/ <?php echo number_format($v['valorventa'] ?? 0, 2); ?></td>
                                            <td>S/ <?php echo number_format($v['igv'] ?? 0, 2); ?></td>
                                            <td class="fw-bold text-success">S/ <?php echo number_format($v['total'] ?? 0, 2); ?></td>
                                            <td class="text-center">
                                                <a href="detalle.php?id=<?php echo $v['idfactura']; ?>" class="btn btn-info btn-sm text-white" title="Ver Detalle">
                                                    <i class="fas fa-eye"></i> Ver
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No hay ventas registradas todavía.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>