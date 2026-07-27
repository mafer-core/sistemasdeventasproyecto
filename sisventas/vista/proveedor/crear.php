<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-truck-loading"></i> Registrar Nuevo Proveedor</h5>
                </div>
                <div class="card-body">
                    <form action="grabar.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nombre o Empresa Proveedora:</label>
                            <input type="text" class="form-control" name="txtnombre" placeholder="Ej. Distribuciones S.A." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">RUC:</label>
                            <input type="text" class="form-control" name="txtruc" placeholder="Ej. 20123456789" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="txttelefono" placeholder="Ej. 054223344">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección:</label>
                            <input type="text" class="form-control" name="txtdireccion" placeholder="Ej. Parque Industrial Mz B">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Proveedor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>