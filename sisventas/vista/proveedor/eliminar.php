<?php
include_once "../../modelo/proveedor.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $objProv = new Proveedor();
    $objProv->setIdproveedor($id);
    
    if ($objProv->delete()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al intentar eliminar el proveedor.";
    }
} else {
    header("Location: listado.php");
    exit();
}
?>