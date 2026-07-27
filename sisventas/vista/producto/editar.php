<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

include_once "../../modelo/producto.php";

$objProd = new Producto();
$id = $_GET['id'];
$prod = $objProd->buscar($id);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Actualizar Producto</h5>
                </div>
                <div class="card-body">
                    <form action="actualizar.php" method="POST">
                        <input type="hidden" name="txtid" value="<?php echo $prod['idproducto']; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto:</label>
                            <input type="text" class="form-control" name="txtnomprodu" value="<?php echo $prod['nomproducto']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unidad de Medida:</label>
                            <input type="text" class="form-control" name="txtunimed" value="<?php echo $prod['unimed']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock:</label>
                            <input type="number" class="form-control" name="txtstock" value="<?php echo $prod['stock']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio Unitario:</label>
                                <input type="number" step="0.01" class="form-control" name="txtpreuni" value="<?php echo $prod['preuni']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Costo Unitario:</label>
                                <input type="number" step="0.01" class="form-control" name="txtcosuni" value="<?php echo $prod['cosuni']; ?>" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>