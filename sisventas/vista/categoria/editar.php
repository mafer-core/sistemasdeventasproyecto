<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

include_once "../../modelo/categoria.php";

$objCat = new Categoria();
$id = $_GET['id'];
$cat = $objCat->buscar($id);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Actualizar Categoría</h5>
                </div>
                <div class="card-body">
                    <form action="actualizar.php" method="POST">
                        <input type="hidden" name="txtid" value="<?php echo $cat['idcategoria']; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre de la Categoría:</label>
                            <input type="text" class="form-control" name="txtnombre" value="<?php echo $cat['nombre']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción:</label>
                            <textarea class="form-control" name="txtdescripcion" rows="3"><?php echo $cat['descripcion']; ?></textarea>
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