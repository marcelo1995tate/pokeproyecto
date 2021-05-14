<?php
require_once('conexion.php');
$path = "http://localhost/pokeproyecto/";

if (empty($_POST['nombre']) || empty($_POST['numero']) || empty($_POST['tipo']) || empty($_FILES['imagen']) || empty($_POST['desc'])){
    header("location: $path");
    die();
}

// Validar y guardar la imagen
$file = $_FILES['imagen'];
$titulo = ucwords(strtolower($_POST['nombre']));

$directorio = "../recursos/imagenes/";
$finalPath = $directorio . $titulo . "." . explode(".", $file["name"])[1];
$arrayImagenes = scandir("../recursos/imagenes/");

if(array_search($_GET['nombre'] . ".png", $arrayImagenes, true)){
    header("location: $path");
    die();
}

if(explode(".", $file["name"])[1] != "png"){
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
// Inserción en la base de datos.
$sql = "INSERT INTO pokemon (nombre, descripcion, numero, id_tipo) VALUES ('$_POST[nombre]', '$_POST[desc]', '$_POST[numero]', '$_POST[tipo]')";

$conexion->query($sql);

header("location: $path");
die();
