<?php
require_once('conexion.php');
$path = "http://localhost/pokeproyecto/";

if (empty($_GET['id']) || empty($_GET['nombre'])) {
    header("location: $path");
    die();
}

$sql = "DELETE FROM pokemon WHERE id=$_GET[id]";
$resultado = $conexion->query($sql);

if ($resultado) {
    $arrayImagenes = scandir("../recursos/imagenes/");
    $image = array_search($_GET['nombre'] . ".png", $arrayImagenes, true);

    if ($image) {
        unlink("../recursos/imagenes/" . $arrayImagenes[$image]);
    }
}

header("location: $path");
die();
