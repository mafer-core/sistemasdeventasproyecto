<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/includes/db.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


$conexion = new DBConexion();
$pdo = $conexion->conectar();

$desde = $_GET['desde'] ?? date('Y-m-01');
$hasta = $_GET['hasta'] ?? date('Y-m-d');

$sql = "SELECT f.idfactura, f.fecha, c.nomcliente, cv.nomcondicion, (f.valorventa + f.igv) AS total 
        FROM Facturas f 
        INNER JOIN Clientes c ON f.idcliente = c.idcliente 
        LEFT JOIN CondicionVenta cv ON f.idcondicion = cv.idcondicion 
        WHERE f.fecha BETWEEN :desde AND :hasta 
        ORDER BY f.fecha DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([':desde' => $desde, ':hasta' => $hasta]);
$ventas = $stmt->fetchAll();
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-calendar-day"></i> Consultar Ventas por Fecha</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-5">
                    <label class="form-label">Desde:</label>
                    <input type="date" name="desde" class="form-control" value="<?= $desde ?>">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Hasta:</label>
                    <input type="date" name="hasta" class="form-control" value="<?= $hasta ?>">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Buscar</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>N° Factura</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Condición</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ventas)): ?>
                            <?php foreach ($ventas as $v): ?>
                            <tr>
                                <td><?= htmlspecialchars($v['idfactura']) ?></td>
                                <td><?= htmlspecialchars($v['fecha']) ?></td>
                                <td><?= htmlspecialchars($v['nomcliente']) ?></td>
                                <td><?= htmlspecialchars($v['nomcondicion'] ?? 'Contado') ?></td>
                                <td>S/ <?= number_format($v['total'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center text-muted">No hay registros de ventas en ese rango.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>