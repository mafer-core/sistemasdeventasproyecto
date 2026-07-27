<?php
include '../../includes/db.php';
include '../layout/header.php'; 


$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusuario = $_POST['idusuario'];
    $password = $_POST['password'];

    $sql = "UPDATE Usuarios SET password = :password WHERE idusuario = :idusuario";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':password' => $password, ':idusuario' => $idusuario])) {
        $mensaje = "<div class='alert alert-success'>Contraseña actualizada exitosamente.</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al actualizar contraseña.</div>";
    }
}
?>

<div class="container mt-4" style="max-width: 500px;">
    <h2>Cambiar Contraseña</h2>
    <?= $mensaje ?>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label>ID Usuario:</label>
            <input type="text" name="idusuario" class="form-control" required placeholder="Ej: 001">
        </div>
        <div class="mb-3">
            <label>Nueva Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning w-100">Actualizar Contraseña</button>
    </form>
</div>

<?php include '../layout/footer.php'; ?>