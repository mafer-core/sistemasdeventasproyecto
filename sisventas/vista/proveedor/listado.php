<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


include_once "../../modelo/proveedor.php";

$objProv = new Proveedor();
$proveedores = $objProv->listado();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-truck"></i> Lista de Proveedores</h5>
                    <a href="crear.php" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Nuevo Proveedor
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Empresa / Proveedor</th>
                                    <th>RUC</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($proveedores)) { 
                                    foreach ($proveedores as $prov) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($prov['idproveedor'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($prov['nomproveedor'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($prov['rucproveedor'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($prov['telproveedor'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($prov['dirproveedor'] ?? ''); ?></td>
                                            <td class="text-center">
                                                <a href="editar.php?id=<?php echo $prov['idproveedor']; ?>" class="btn btn-warning btn-sm" title="Editar">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <a href="eliminar.php?id=<?php echo $prov['idproveedor']; ?>" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este proveedor?');">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No hay proveedores registrados todavía.</td>
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