<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Registrar Nuevo Producto</h5>
                </div>
                <div class="card-body">
                    <form action="grabar.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto:</label>
                            <input type="text" class="form-control" name="txtnomprodu" placeholder="Ej. Fanta 1 Litro" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unidad de Medida:</label>
                            <input type="text" class="form-control" name="txtunimed" placeholder="Ej. Unidades, Litros, Kg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock Inicial:</label>
                            <input type="number" class="form-control" name="txtstock" placeholder="0" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio Unitario (Venta):</label>
                                <input type="number" step="0.01" class="form-control" name="txtpreuni" placeholder="0.00" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Costo Unitario:</label>
                                <input type="number" step="0.01" class="form-control" name="txtcosuni" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>