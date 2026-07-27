<?php
include_once "../../modelo/cliente.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $objCliente = new Cliente();
    $objCliente->setIdcliente($id);
    
    if ($objCliente->delete()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al intentar eliminar el cliente.";
    }
} else {
    header("Location: listado.php");
    exit();
}
?>