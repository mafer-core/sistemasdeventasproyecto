<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/includes/db.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


$conexion = new DBConexion();
$pdo = $conexion->conectar();

$sql = "SELECT p.idproducto, p.nomproducto, c.nomcategoria, p.unimed, p.stock, p.preuni 
        FROM Productos p 
        LEFT JOIN Categorias c ON p.idcategoria = c.idcategoria 
        ORDER BY p.stock ASC";

$stmt = $pdo->query($sql);
$productos = $stmt->fetchAll();
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-cubes"></i> Control de Stock de Productos</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>U. Medida</th>
                            <th>Stock Actual</th>
                            <th>Precio U.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['idproducto']) ?></td>
                            <td><?= htmlspecialchars($p['nomproducto']) ?></td>
                            <td><?= htmlspecialchars($p['nomcategoria'] ?? 'Sin Categoría') ?></td>
                            <td><?= htmlspecialchars($p['unimed']) ?></td>
                            <td>
                                <span class="badge bg-<?= $p['stock'] <= 10 ? 'danger' : 'success' ?>">
                                    <?= $p['stock'] ?>
                                </span>
                            </td>
                            <td>S/ <?= number_format($p['preuni'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>