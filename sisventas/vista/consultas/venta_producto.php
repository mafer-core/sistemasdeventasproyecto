<?php
// Activar reporte de errores durante desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos 
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "sisventas";

$conexion = new mysqli($host, $user, $pass, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Incluir vistas de layout
include_once '../layout/header.php';
include_once '../layout/navbar.php';

// Capturar el término de búsqueda si existe
$busqueda = isset($_GET['producto']) ? trim($_GET['producto']) : '';
?>

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Consulta de Ventas por Producto</h4>
        </div>
        <div class="card-body">
            
            <!-- Formulario de búsqueda -->
            <form action="" method="GET" class="row g-3 mb-4">
                <div class="col-md-9">
                    <label for="producto" class="form-label font-weight-bold">Nombre o Código del Producto:</label>
                    <input type="text" 
                           class="form-control" 
                           id="producto" 
                           name="producto" 
                           placeholder="Ejemplo: Pilsen, Aceite, PROD000001..." 
                           value="<?php echo htmlspecialchars($busqueda); ?>" required>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Buscar Ventas
                    </button>
                </div>
            </form>

            <hr>

            <!-- Tabla de Resultados -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th>Código Prod.</th>
                            <th>Producto</th>
                            <th>N° Factura</th>
                            <th>Fecha Venta</th>
                            <th>Cantidad</th>
                            <th>Precio Unit.</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($busqueda)) {
                            // Consulta para obtener las ventas detalladas según el producto
                            $sql = "SELECT 
                                        p.idproducto,
                                        p.nomproducto,
                                        df.numfactura,
                                        f.fechafactura,
                                        df.cantidad,
                                        df.precioventa,
                                        (df.cantidad * df.precioventa) AS subtotal
                                    FROM productos p
                                    INNER JOIN detallefactura df ON p.idproducto = df.idproducto
                                    INNER JOIN facturas f ON df.numfactura = f.numfactura
                                    WHERE p.nomproducto LIKE ? OR p.idproducto LIKE ?
                                    ORDER BY f.fechafactura DESC";

                            $stmt = $conexion->prepare($sql);
                            $param = "%" . $busqueda . "%";
                            $stmt->bind_param("ss", $param, $param);
                            $stmt->execute();
                            $resultado = $stmt->get_result();

                            if ($resultado->num_rows > 0) {
                                $totalGeneral = 0;
                                while ($fila = $resultado->fetch_assoc()) {
                                    $totalGeneral += $fila['subtotal'];
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($fila['idproducto']) . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['nomproducto']) . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['numfactura']) . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['fechafactura']) . "</td>";
                                    echo "<td>" . htmlspecialchars($fila['cantidad']) . "</td>";
                                    echo "<td>S/. " . number_format($fila['precioventa'], 2) . "</td>";
                                    echo "<td class='text-right'>S/. " . number_format($fila['subtotal'], 2) . "</td>";
                                    echo "</tr>";
                                }
                                echo "<tr class='table-info font-weight-bold'>";
                                echo "<td colspan='6' class='text-right'>Total Recaudado por Ventas:</td>";
                                echo "<td>S/. " . number_format($totalGeneral, 2) . "</td>";
                                echo "</tr>";
                            } else {
                                echo "<tr><td colspan='7' class='text-center text-muted'>No se encontraron registro de ventas para el producto '<strong>" . htmlspecialchars($busqueda) . "</strong>'.</td></tr>";
                            }
                            $stmt->close();
                        } else {
                            echo "<tr><td colspan='7' class='text-center text-muted'>Ingrese el nombre o código de un producto en la barra superior para ver su historial de ventas.</td></tr>";
                        }
                        
                        $conexion->close();
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
// esta en el pie de página
include_once '../layout/footer.php';
?>