<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";

?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-folder-plus"></i> Registrar Nueva Categoría</h5>
                </div>
                <div class="card-body">
                    <form action="grabar.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nombre de la Categoría:</label>
                            <input type="text" class="form-control" name="txtnombre" placeholder="Ej. Bebidas, Abarrotes, etc." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción:</label>
                            <textarea class="form-control" name="txtdescripcion" rows="3" placeholder="Detalles de la categoría"></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>