<?php
require_once('conexion.php');
session_start();

if(!empty($_POST['usuario']) && !empty($_POST['contrasenia'])){
    $sql = "SELECT 1 FROM usuario WHERE nombre = '$_POST[usuario]' AND contrasenia = '$_POST[contrasenia]'";

    $result = $conexion->query($sql);

    if($result->num_rows > 0){
        $_SESSION['usuario'] = $_POST['usuario'];
        
        header("location: http://localhost/pokeproyecto/");
        exit();

    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
        header("location: http://localhost/pokeproyecto/");
        exit();
    }
}

if(isset($_GET['logout'])){
    session_destroy();

    header("location: http://localhost/pokeproyecto/");
    exit();
}
