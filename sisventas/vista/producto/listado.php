<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


include_once "../../modelo/producto.php";

$objProd = new Producto();
$productos = $objProd->listado();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-boxes"></i> Lista de Productos</h5>
                    <a href="crear.php" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Nuevo Producto
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Unidad Medida</th>
                                    <th>Stock</th>
                                    <th>Precio U.</th>
                                    <th>Costo U.</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($productos)) { 
                                    foreach ($productos as $prod) { ?>
                                        <tr>
                                            <td><?php echo $prod['idproducto']; ?></td>
                                            <td><?php echo $prod['nomproducto']; ?></td>
                                            <td><?php echo $prod['unimed']; ?></td>
                                            <td><?php echo $prod['stock']; ?></td>
                                            <td>$<?php echo number_format($prod['preuni'], 2); ?></td>
                                            <td>$<?php echo number_format($prod['cosuni'], 2); ?></td>
                                            <td class="text-center">
                                                <a href="editar.php?id=<?php echo $prod['idproducto']; ?>" class="btn btn-warning btn-sm" title="Editar">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <a href="eliminar.php?id=<?php echo $prod['idproducto']; ?>" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?');">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No hay productos registrados todavía.</td>
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