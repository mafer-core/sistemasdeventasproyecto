<?php
include_once "../../modelo/producto.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $objProd = new Producto();
    $objProd->setIdproducto($id);
    
    // Ejecutamos la función delete que creamos en el modelo
    if ($objProd->delete()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al intentar eliminar el producto.";
    }
} else {
    header("Location: listado.php");
    exit();
}
?>