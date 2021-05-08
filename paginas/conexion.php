<?php
$servername = "localhost";
$username = "root";
$password ="";
$database ="pokedex";
$port = "3306";

$conexion = new mysqli(
    $servername,
    $username,
    $password,
    $database,
    $port);

if($conexion->connect_error){
    echo "Error en conexion <br>";
}/*else{
    echo " conexion ok<br>";

}*/