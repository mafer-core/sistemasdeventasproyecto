<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


include_once "../../modelo/cliente.php";

$objCliente = new Cliente();
$id = $_GET['id'];
$cli = $objCliente->buscar($id);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-user-edit"></i> Actualizar Cliente</h5>
                </div>
                <div class="card-body">
                    <form action="actualizar.php" method="POST">
                        <input type="hidden" name="txtid" value="<?php echo $cli['idcliente']; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre o Razón Social:</label>
                            <input type="text" class="form-control" name="txtnombre" value="<?php echo $cli['nombre']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">DNI / RUC:</label>
                            <input type="text" class="form-control" name="txtdni" value="<?php echo $cli['dni']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="txttelefono" value="<?php echo $cli['telefono']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección:</label>
                            <input type="text" class="form-control" name="txtdireccion" value="<?php echo $cli['direccion']; ?>">
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