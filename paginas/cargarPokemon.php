<?php
session_start();
require_once('conexion.php');
$path = "http://localhost/pokeproyecto/";

if (empty($_POST['nombre']) || empty($_POST['numero']) || empty($_POST['tipo']) || empty($_FILES['imagen']) || empty($_POST['desc']) || !isset($_SESSION['usuario'])){
    $_SESSION['error'] = "Error al crear pokemon! Revise los campos o si se encuentra logueado.";
    header("location: $path");
    die();
}

// Validar y guardar la imagen
$file = $_FILES['imagen'];
$titulo = ucwords(strtolower($_POST['nombre']));

$directorio = "../recursos/imagenes/";
$finalPath = $directorio . $titulo . "." . explode(".", $file["name"])[1];

if (!getimagesize($file["tmp_name"])) {
    $_SESSION['error'] = "El archivo subido debe ser una imágen!";
    header("location: $path");
    die();
}

if(explode(".", $file["name"])[1] != "png"){
    $_SESSION['error'] = "La imagen subida debe estar en formato PNG!";
    header("location: $path");
    die();
}

if (file_exists($finalPath)) {
    $_SESSION['error'] = "Ya existe un pokemon con ese nombre!";
    header("location: $path");
    die();
}

if (!move_uploaded_file($file["tmp_name"], $finalPath)) {
    $_SESSION['error'] = "Error al intentar guardar la imagen! intente nuevamente.";
    header("location: $path");
    die();
}
// Inserción en la base de datos.
$sql = "INSERT INTO pokemon (nombre, descripcion, numero, id_tipo) VALUES ('$titulo', '$_POST[desc]', '$_POST[numero]', '$_POST[tipo]')";

$conexion->query($sql);

header("location: $path");
die();
