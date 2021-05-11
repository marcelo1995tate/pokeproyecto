<?php
require_once('conexion.php');
$path = "http://localhost/pokeproyecto/";

if (empty($_POST['nombre']) || empty($_POST['id']) || empty($_POST['tipo']) || empty($_FILES['imagen']) || empty($_POST['desc'])){
    header("location: $path");
    die();
}

// Validar y guardar la imagen
$file = $_FILES['imagen'];
$titulo = ucwords(strtolower($_POST['nombre']));

$directorio = "../recursos/imagenes/";
$finalPath = $directorio . $titulo . "." . explode(".", $file["name"])[1];

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
$sql = "INSERT INTO pokemon VALUES ('$_POST[id]', '$_POST[nombre]', '$_POST[desc]', '$_POST[tipo]')";

var_dump($conexion->query($sql));

header("location: $path");
die();
