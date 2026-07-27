<?php
include_once "../../modelo/proveedor.php";

if ($_POST) {
    $objProv = new Proveedor();
    
    $objProv->setNombre($_POST['txtnombre']);
    $objProv->setRuc($_POST['txtruc']);
    $objProv->setTelefono($_POST['txttelefono']);
    $objProv->setDireccion($_POST['txtdireccion']);
    
    if ($objProv->create()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al registrar el proveedor.";
    }
}
?>