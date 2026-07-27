<?php
include_once "../../modelo/categoria.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $objCat = new Categoria();
    $objCat->setIdcategoria($id);
    
    if ($objCat->delete()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al intentar eliminar la categoría.";
    }
} else {
    header("Location: listado.php");
    exit();
}
?>