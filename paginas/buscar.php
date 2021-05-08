<?php
require_once('conexion.php');


function mostrar_todos()
{
    $sql = "select  p.*, t.tipo from pokemon as p join tipo t on p.id_tipo=t.id ";

    $resultado = $GLOBALS['conexion']->query($sql);

    $registro = "";
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {

            $registro .= '<tbody>
                            <tr>
                              <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['nombre'] . '.png" </td>
                              <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['tipo'] . '.png"</td>
                              <td> ' . $fila['id'] . '</td>
                              <td> ' . $fila['nombre'] . '</td>
                            </tr>
                        </tbody>';
        }
        return $registro;
    } else {
        echo "No hay registros almacenados <br>";
    }
}

function mostrar_pokemon($pokemon)
{

    $sql = "select  p.*, t.tipo from pokemon as p join tipo t on p.id_tipo=t.id where p.nombre like '%" . ucwords(strtolower($pokemon)) . "%'";

    $resultado = $GLOBALS['conexion']->query($sql);

    $registro = "";
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {

            $registro .= '<tbody>
                            <tr>
                              <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['nombre'] . '.png" </td>
                              <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['tipo'] . '.png"</td>
                              <td> ' . $fila['id'] . '</td>
                              <td> ' . $fila['nombre'] . '</td>
                            </tr>
                        </tbody>';
        }
        return $registro;
    } else {
        echo "No se encontró el buscado <br>";
        return mostrar_todos();
    }
}
