<?php
session_start();
require_once('conexion.php');
$path = "http://localhost/pokeproyecto/";

if (empty($_GET['id']) || empty($_GET['nombre']) || !isset($_SESSION['usuario'])) {
    $_SESSION['error'] = "Petición de borrado no cumple los requisitos";
    header("location: $path");
    die();
}

$sql = "DELETE FROM pokemon WHERE id=$_GET[id] AND nombre='$_GET[nombre]'";
$resultado = $conexion->query($sql);

if ($resultado) {
    $arrayImagenes = scandir("../recursos/imagenes/");
    $image = array_search($_GET['nombre'] . ".png", $arrayImagenes, true);

    if ($image) {
        unlink("../recursos/imagenes/" . $arrayImagenes[$image]);
    }
} else
    $_SESSION['error'] = "No se encontro el pokemon a eliminar";

header("location: $path");
die();
