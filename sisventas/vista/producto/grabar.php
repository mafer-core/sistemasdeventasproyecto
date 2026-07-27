<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/producto.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturamos los datos del formulario
    $nomprodu = $_POST['txtnomprodu'];
    $unimed   = $_POST['txtunimed'];
    $stock    = $_POST['txtstock'];
    $preuni   = $_POST['txtpreuni'];
    $cosuni   = $_POST['txtcosuni'];

    // Instanciamos el modelo y asignamos los valores usando los setters
    $objProd = new Producto();
    $objProd->setNomprodu($nomprodu);
    $objProd->setUnimed($unimed);
    $objProd->setStock($stock);
    $objProd->setPreuni($preuni);
    $objProd->setCosuni($cosuni);

    // Ejecutamos el método para crear el registro
    $resultado = $objProd->create();

    if ($resultado) {
        // Redireccionamos al listado si se guardó con éxito
        header("Location: listado.php");
        exit();
    } else {
        echo "Error al registrar el producto.";
    }
}
?>