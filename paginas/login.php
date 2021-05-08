<?php
require_once('conexion.php');

if(!empty($_POST['usuario']) && !empty($_POST['contrasenia'])){
    $sql = "SELECT 1 FROM usuario WHERE nombre = '$_POST[usuario]' AND contrasenia = '$_POST[contrasenia]'";

    $result = $conexion->query($sql);

    if($result->num_rows > 0){
        session_start();
        
        $_SESSION['usuario'] = $_POST['usuario'];
        
        header("location: http://localhost/pokeproyecto/");
        exit();

    } else {

        header("location: http://localhost/pokeproyecto/?exit=0");
        exit();
    }
}

if(isset($_GET['logout'])){
    session_start();
    session_destroy();

    header("location: http://localhost/pokeproyecto/");
    exit();
}
