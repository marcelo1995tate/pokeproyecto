<?php
require_once('conexion.php');

function buscarTipos()
{
    $sql = "select * from tipo ";

    $resultado = $GLOBALS['conexion']->query($sql);

    $registro = "";
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $registro .= "<option value=$fila[id]>" . ucwords($fila['tipo']) . "</option>";
        }
    } else {
        $registro .= "<option>No hay tipos</option>";
    }
    return $registro;
}

function mostrar_todos(bool $sesion)
{
    $sql = "select  p.*, t.tipo from pokemon as p join tipo t on p.id_tipo=t.id ";

    $resultado = $GLOBALS['conexion']->query($sql);

    $registro = "";
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {

            $registro .=
                '<tr>
                <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['nombre'] . '.png" </td>
                <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['tipo'] . '.png"</td>
                <td> ' . $fila['id'] . '</td>
                <td> ' . $fila['nombre'] . '</td>';

            $registro .= $sesion ?
                '<td>
            <button type="button" class="btn m-3 btn-outline-warning">Modificar</button>
            <a href="paginas/borrar.php?id=' . $fila['id'] . '&nombre=' . $fila['nombre'] . '" class="btn m-3 btn-outline-danger">Borrar</button></td>
            </tr>' : '</tr>';
        }
        return $registro;
    } else {
        echo "No hay registros almacenados <br>";
    }
}

function mostrar_pokemon($pokemon, bool $sesion)
{

    $sql = "select  p.*, t.tipo from pokemon as p join tipo t on p.id_tipo=t.id where p.nombre like '%" . ucwords(strtolower($pokemon)) . "%'";

    $resultado = $GLOBALS['conexion']->query($sql);

    $registro = "";
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {

            $registro .=
                '<tr>
                <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['nombre'] . '.png" </td>
                <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['tipo'] . '.png"</td>
                <td> ' . $fila['id'] . '</td>
                <td> ' . $fila['nombre'] . '</td>';

            $registro .= $sesion ?
                '<td><button class="btn m-3 btn-outline-warning">Modificar</button>
            <button  value="modificar"class="btn m-3 btn-outline-danger">Borrar</button></td>
            </tr>' : '</tr>';
        }
        return $registro;
    } else {
        echo "No se encontró el buscado <br>";
        return mostrar_todos($sesion);
    }
}

function obtenerCabeceras(bool $sesion)
{
    $cabeceras =
        '<tr>
        <th scope="col">Imagen</th>
        <th scope="col">Tipo</th>
        <th scope="col">Numero</th>
        <th scope="col">Nombre</th>';

    if ($sesion)
        $cabeceras .= '<th scope="col">Acciones</th>';


    $cabeceras .= '</tr>';
    return $cabeceras;
}
