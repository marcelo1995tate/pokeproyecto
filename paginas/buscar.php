<?php
require_once('conexion.php');

function buscarTipos()
{
    $sql = "SELECT * FROM tipo ";

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
    $sql = "select  p.*, t.tipo from pokemon as p join tipo t on p.id_tipo=t.id order by p.numero";

    $resultado = $GLOBALS['conexion']->query($sql);

    $registro = "";
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {

            $registro .=
                '<tr>
                <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['nombre'] . '.png" </td>
                <td class="align-middle"><img style="width: 60px; height: 60px;" src="recursos/imagenes/' . $fila['tipo'] . '.png"</td>
                <td class="align-middle"> ' . sprintf("%03d", $fila['numero']) . '</td>
                <td class="align-middle"> ' . $fila['nombre'] . '</td>';

            if ($sesion)
                $registro .= '<td class="align-middle">
            <a href="modificar.php?pokemon=' . $fila['id'] . '" class="btn m-3 btn-outline-warning">Modificar</a>
            <a href="paginas/borrar.php?id=' . $fila['id'] . '&nombre=' . $fila['nombre'] . '" class="btn m-3 btn-outline-danger">Borrar</a></td>';

            $registro .= '<td class="align-middle"><a href="poke-detalle.php?pokemon=' . $fila['id'] . '" class="btn m-3 btn-outline-info"><i class ="fas fa-eye"></i></a></td></tr>';
        }

        return $registro;
    } else {
        echo "No hay registros almacenados <br>";
    }
}

function mostrar_pokemon($pokemon, bool $sesion)
{
    $pokemon = ucwords(strtolower($pokemon));
    $sql = "select  p.*, t.tipo from pokemon as p join tipo t on p.id_tipo=t.id where p.nombre like '" . $pokemon . "%'";

    $resultado = $GLOBALS['conexion']->query($sql);

    $registro = "";
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {

            $registro .=
                '<tr>
                <td><img style="width: 100px; height: 100px;" src="recursos/imagenes/' . $fila['nombre'] . '.png" </td>
                <td class="align-middle"><img style="width: 60px; height: 60px;" src="recursos/imagenes/' . $fila['tipo'] . '.png"</td>
                <td class="align-middle"> ' . sprintf("%03d", $fila['numero']) . '</td>
                <td class="align-middle"> ' . str_replace($pokemon, "<u>$pokemon</u>", $fila['nombre']) . '</td>';

            if ($sesion)
                $registro .= '<td class="align-middle">
            <a href="modificar.php?pokemon=' . $fila['id'] . '" class="btn m-3 btn-outline-warning">Modificar</a>
            <button type="submit" value="modificar"class="btn m-3 btn-outline-danger">Borrar</button></td>';

            $registro .= '<td class="align-middle"><a href="poke-detalle.php?pokemon=' . $fila['id'] . '" class="btn m-3 btn-outline-info"><i class ="fas fa-eye"></i></a></td></tr>';
        }

        return $registro;
    } else {
        echo "<p class=\"text-white p-1\">No se encontró el buscado</p>";
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


    $cabeceras .= '<th scope="col">Ver</th></tr>';
    return $cabeceras;
}
