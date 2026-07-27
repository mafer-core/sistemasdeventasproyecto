<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/includes/db.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

$conexion = new DBConexion();
$pdo = $conexion->conectar();

$sql = "SELECT f.idfactura, f.fecha, c.nomcliente, (f.valorventa + f.igv) AS total 
        FROM Facturas f 
        INNER JOIN Clientes c ON f.idcliente = c.idcliente 
        ORDER BY total DESC 
        LIMIT 10";

$stmt = $pdo->query($sql);
$ranking = $stmt->fetchAll();
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-trophy"></i> Ranking de Ventas (Top 10 Ingresos)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Posición</th>
                            <th>N° Factura</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $pos = 1; foreach ($ranking as $r): ?>
                        <tr>
                            <td><span class="badge bg-warning text-dark fs-6">#<?= $pos++ ?></span></td>
                            <td><?= htmlspecialchars($r['idfactura']) ?></td>
                            <td><?= htmlspecialchars($r['fecha']) ?></td>
                            <td><?= htmlspecialchars($r['nomcliente']) ?></td>
                            <td class="text-success fw-bold">S/ <?= number_format($r['total'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>