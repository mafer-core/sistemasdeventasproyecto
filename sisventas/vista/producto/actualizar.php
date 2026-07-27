<?php
include_once "../../modelo/producto.php";

if ($_POST) {
    $objProd = new Producto();
    
    $objProd->setIdproducto($_POST['txtid']);
    $objProd->setNomprodu($_POST['txtnomprodu']);
    $objProd->setUnimed($_POST['txtunimed']);
    $objProd->setStock($_POST['txtstock']);
    $objProd->setPreuni($_POST['txtpreuni']);
    $objProd->setCosuni($_POST['txtcosuni']);
    
    if ($objProd->update()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>