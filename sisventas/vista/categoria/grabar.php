<?php
include_once "../../modelo/categoria.php";

if ($_POST) {
    $objCat = new Categoria();
    $objCat->setNombre($_POST['txtnombre']);
    $objCat->setDescripcion($_POST['txtdescripcion']);
    
    if ($objCat->create()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al registrar la categoría.";
    }
}
?>