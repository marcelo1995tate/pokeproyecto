<?php
session_start();
require_once('conexion.php');
$directorio = "../recursos/imagenes/";

if (empty($_POST['nombre']) || empty($_POST['numero']) || empty($_POST['tipo']) || empty($_POST['desc']) || empty($_POST['id']) || !isset($_SESSION['usuario'])) {
    $_SESSION['error'] = "Error al modificar pokemon! Revise los campos o si se encuentra logueado.";
    header("location: http://localhost/pokeproyecto/");
    die();
}

$path = "http://localhost/pokeproyecto/modificar.php?pokemon=$_POST[id]";

$sql = "SELECT nombre FROM pokemon WHERE id = $_POST[id]";

$antiguoTitulo = $conexion->query($sql)->fetch_assoc()['nombre'];

if (is_null($antiguoTitulo)) {
    $_SESSION['error'] = "Imposible modificar pokemon inexistente!";
    header("location: http://localhost/pokeproyecto/");
}

$titulo = ucwords(strtolower($_POST['nombre']));

// Validar y guardar la imagen
if (!empty($_FILES['imagen']['tmp_name'])) {
    $file = $_FILES['imagen'];

    $finalPath = $directorio . $titulo . ".png";

    if (!getimagesize($file["tmp_name"])) {
        $_SESSION['error'] = "El archivo subido debe ser una imágen!";
        header("location: $path");
        die();
    }

    if (explode(".", $file["name"])[1] != "png") {
        $_SESSION['error'] = "La imagen subida debe estar en formato PNG!";
        header("location: $path");
        die();
    }

    if (file_exists($finalPath)) {
        if ($antiguoTitulo != $titulo) {
            $_SESSION['error'] = "Ya existe un pokemon con ese nombre!";
            header("location: $path");
            die();
        } else {
            unlink($finalPath);
        }
    } else {
        unlink($directorio . $antiguoTitulo . ".png");
    }

    if (!move_uploaded_file($file["tmp_name"], $finalPath)) {
        $_SESSION['error'] = "Error al intentar guardar la imagen! intente nuevamente.";
        header("location: $path");
        die();
    }
} else {
    $imagenesGuardadas = scandir($directorio);

    if ($titulo != $antiguoTitulo) {
        $imagenAntigua = $directorio . $antiguoTitulo . ".png";

        if (array_search($titulo . ".png", $imagenesGuardadas)) {
            $_SESSION['error'] = "Ya existe un pokemon con ese nombre!";
            header("location: $path");
            die();
        } else
            $imagenActualizada = $directorio . $titulo . ".png";

        if (!rename($imagenAntigua, $imagenActualizada)) {
            $_SESSION['error'] = "Error al modificar el nombre del pokemon! intente nuevamente.";
            header("location: $path");
            die();
        }
    }
}

// Inserción en la base de datos.
$sql = "UPDATE pokemon SET nombre='$titulo', descripcion='$_POST[desc]', numero ='$_POST[numero]', id_tipo='$_POST[tipo]' WHERE id = '$_POST[id]'";

$resultado = $conexion->query($sql);

header("location: http://localhost/pokeproyecto/");
die();
