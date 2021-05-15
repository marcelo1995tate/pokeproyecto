<?php
require_once("conexion.php");

$datos = [];

if (isset($_GET['pokemon'])) {
    $sql = "select  p.*, t.tipo from pokemon as p join tipo t on p.id_tipo=t.id where p.id ='" . $_GET['pokemon'] ."'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $datos = $result->fetch_assoc();
    }

}

function buscarPokemonImagen($datos)
{
    if (empty($datos)) return;
    echo '<img src="recursos/imagenes/' . $datos['nombre'] . '.png" style="width: 300px" class="p-3">';
}

function buscarPokemontipo($datos)
{
    if (empty($datos)) return;
    echo '<img src="recursos/imagenes/' . $datos['tipo'] . '.png" style="width: 75px" class="p-3"></td>';
}

function buscarPokemonnombre($datos)
{
    if (empty($datos)) return;
    echo '<h2 class="text-center p-3">' . $datos['nombre'] . '</h2>';
}

function buscarPokemondescripcion($datos)
{
    if (empty($datos)) return;
    echo '<p class="text-justify p-3">' . $datos['descripcion'] . '</p>';
}
