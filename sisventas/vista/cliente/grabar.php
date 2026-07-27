<?php
include_once "../../modelo/cliente.php";

if ($_POST) {
    $objCliente = new Cliente();
    
    $objCliente->setNombre($_POST['txtnombre']);
    $objCliente->setDni($_POST['txtdni']);
    $objCliente->setTelefono($_POST['txttelefono']);
    $objCliente->setDireccion($_POST['txtdireccion']);
    
    if ($objCliente->create()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al registrar el cliente.";
    }
}
?>