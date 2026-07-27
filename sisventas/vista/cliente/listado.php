<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

include_once "../../modelo/cliente.php";

$objCliente = new Cliente();
$clientes = $objCliente->listado();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Lista de Clientes</h5>
                    <a href="crear.php" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Nuevo Cliente
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre / Razón Social</th>
                                    <th>DNI / RUC</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($clientes)) { 
                                    foreach ($clientes as $cli) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($cli['idcliente'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($cli['nomcliente'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($cli['ruccliente'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($cli['telcliente'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($cli['dircliente'] ?? ''); ?></td>
                                            <td class="text-center">
                                                <a href="editar.php?id=<?php echo $cli['idcliente']; ?>" class="btn btn-warning btn-sm" title="Editar">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <a href="eliminar.php?id=<?php echo $cli['idcliente']; ?>" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No hay clientes registrados todavía.</td>
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