<?php
require_once('conexion.php');
$path = "http://localhost/pokeproyecto/";

if (empty($_POST['nombre']) || empty($_POST['numero']) || empty($_POST['tipo']) || empty($_POST['desc']) || empty($_POST['id'])) {
    header("location: $path");
    die();
}

$titulo = ucwords(strtolower($_POST['nombre']));

// Validar y guardar la imagen
if (!empty($_FILES['imagen']['tmp_name'])) {
    $file = $_FILES['imagen'];

    $directorio = "../recursos/imagenes/";
    $finalPath = $directorio . $titulo . "." . explode(".", $file["name"])[1];
    $arrayImagenes = scandir("../recursos/imagenes/");

    if (array_search($titulo . ".png", $arrayImagenes, true)) {
        header("location: $path");
        die();
    }

    if (explode(".", $file["name"])[1] != "png") {
        header("location: $path");
        die();
    }

    if (!getimagesize($file["tmp_name"])) {
        header("location: $path");
        die();
    }

    if (file_exists($finalPath)) {
        header("location: $path");
        die();
    }

    if (!move_uploaded_file($file["tmp_name"], $finalPath)) {
        header("location: $path");
        die();
    }
}

// Inserción en la base de datos.
$sql = "UPDATE pokemon SET nombre='$titulo', descripcion='$_POST[desc]', numero ='$_POST[numero]', id_tipo='$_POST[tipo]' WHERE id = '$_POST[id]'";

$resultado = $conexion->query($sql);

// Si se ejecuto la query y se actualizo la imagen borramos la anterior.
if ($resultado && !empty($_FILES['imagen']['tmp_name'])) {
    $arrayImagenes = scandir("../recursos/imagenes/");
    $image = array_search($titulo . ".png", $arrayImagenes, true);

    if ($image) {
        unlink("../recursos/imagenes/" . $arrayImagenes[$image]);
    }
}

header("location: $path");
die();
