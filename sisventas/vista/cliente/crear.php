<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-user-plus"></i> Registrar Nuevo Cliente</h5>
                </div>
                <div class="card-body">
                    <form action="grabar.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nombre o Razón Social:</label>
                            <input type="text" class="form-control" name="txtnombre" placeholder="Ej. Juan Pérez" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">DNI / RUC:</label>
                            <input type="text" class="form-control" name="txtdni" placeholder="Ej. 74839201" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="txttelefono" placeholder="Ej. 987654321">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección:</label>
                            <input type="text" class="form-control" name="txtdireccion" placeholder="Ej. Av. Principal 123">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>