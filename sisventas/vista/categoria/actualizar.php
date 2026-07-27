<?php
include_once "../../modelo/categoria.php";

if ($_POST) {
    $objCat = new Categoria();
    $objCat->setIdcategoria($_POST['txtid']);
    $objCat->setNombre($_POST['txtnombre']);
    $objCat->setDescripcion($_POST['txtdescripcion']);
    
    if ($objCat->update()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al actualizar la categoría.";
    }
}
?>