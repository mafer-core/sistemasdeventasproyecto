<?php
// 1. Incluir encabezados del layout
include_once '../layout/header.php';
include_once '../layout/navbar.php';

// 2. Incluir la conexión
require_once '../../includes/db.php';

// 3. Consultar la tabla usuarios
try {
    $db = new DBConexion();
    $con = $db->conectar();

    $sql = "SELECT * FROM usuarios";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger container mt-3'>Error al cargar usuarios: " . $e->getMessage() . "</div>";
    $usuarios = [];
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Usuarios</h2>
        <a href="crear.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($u['idusuario']); ?></td>
                            <td><?php echo htmlspecialchars($u['nomusuario']); ?></td>
                            <td><?php echo htmlspecialchars($u['nombres'] . ' ' . $u['apellidos']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $u['estado'] == 1 ? 'success' : 'danger'; ?>">
                                    <?php echo $u['estado'] == 1 ? 'Activo' : 'Inactivo'; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="editar.php?id=<?php echo $u['idusuario']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="cambiar_password.php?id=<?php echo $u['idusuario']; ?>" class="btn btn-info btn-sm">Clave</a>
                                <a href="eliminar.php?id=<?php echo $u['idusuario']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once '../layout/footer.php';
?>