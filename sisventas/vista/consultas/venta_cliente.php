<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/includes/db.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


$conexion = new DBConexion();
$pdo = $conexion->conectar();

$idCliente = $_GET['idcliente'] ?? '';
$ventas = [];

if (!empty($idCliente)) {
    $sql = "SELECT f.idfactura, f.fecha, p.nomproducto, df.cant, df.preuni, (df.cant * df.preuni) AS subtotal 
            FROM Facturas f 
            INNER JOIN DetalleFactura df ON f.idfactura = df.idfactura 
            INNER JOIN Productos p ON df.idproducto = p.idproducto 
            WHERE f.idcliente = :idcliente 
            ORDER BY f.fecha DESC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idcliente' => $idCliente]);
    $ventas = $stmt->fetchAll();
}
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-tag"></i> Consultar Ventas por Cliente</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-9">
                    <input type="text" name="idcliente" class="form-control" placeholder="Ingrese ID del Cliente (Ej: CLI0000001)" value="<?= htmlspecialchars($idCliente) ?>" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success w-100"><i class="fas fa-search"></i> Buscar Cliente</button>
                </div>
            </form>

            <?php if (!empty($ventas)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>N° Factura</th>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio U.</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $v): ?>
                        <tr>
                            <td><?= htmlspecialchars($v['idfactura']) ?></td>
                            <td><?= htmlspecialchars($v['fecha']) ?></td>
                            <td><?= htmlspecialchars($v['nomproducto']) ?></td>
                            <td><?= $v['cant'] ?></td>
                            <td>S/ <?= number_format($v['preuni'], 2) ?></td>
                            <td>S/ <?= number_format($v['subtotal'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php elseif ($idCliente): ?>
                <p class="text-warning text-center fw-bold">No se encontraron ventas para el cliente "<?= htmlspecialchars($idCliente) ?>".</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>