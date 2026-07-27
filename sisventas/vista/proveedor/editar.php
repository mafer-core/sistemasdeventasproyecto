<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


include_once "../../modelo/proveedor.php";

$objProv = new Proveedor();
$id = $_GET['id'];
$prov = $objProv->buscar($id);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Actualizar Proveedor</h5>
                </div>
                <div class="card-body">
                    <form action="actualizar.php" method="POST">
                        <input type="hidden" name="txtid" value="<?php echo $prov['idproveedor']; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre o Empresa Proveedora:</label>
                            <input type="text" class="form-control" name="txtnombre" value="<?php echo $prov['nombre']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">RUC:</label>
                            <input type="text" class="form-control" name="txtruc" value="<?php echo $prov['ruc']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="txttelefono" value="<?php echo $prov['telefono']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección:</label>
                            <input type="text" class="form-control" name="txtdireccion" value="<?php echo $prov['direccion']; ?>">
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