<?php
include_once "../../modelo/cliente.php";

if ($_POST) {
    $objCliente = new Cliente();
    
    $objCliente->setIdcliente($_POST['txtid']);
    $objCliente->setNombre($_POST['txtnombre']);
    $objCliente->setDni($_POST['txtdni']);
    $objCliente->setTelefono($_POST['txttelefono']);
    $objCliente->setDireccion($_POST['txtdireccion']);
    
    if ($objCliente->update()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al actualizar el cliente.";
    }
}
?>