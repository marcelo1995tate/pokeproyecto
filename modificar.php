<?php
require_once('paginas/detalle-pokemon.php');
require_once('paginas/buscar.php');
session_start();

if(empty($datos)){
    header('location: index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/cd9f94a914.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="recursos/css/main.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Pokedex</title>
</head>

<body class="bg-dark text-white">
    <?php
    if (isset($_SESSION['usuario']))
        require_once('recursos/templates/headerLogueado.php');
    else
        require_once('recursos/templates/header.php');

    if (isset($_GET['exit'])) {
        switch ($_GET['exit']) {
            case 0:
                echo "Usuario o contraseña incorrectos";
        }
    }
    ?>
    <main>
        <form action="paginas/modificarPokemon.php" method="POST" enctype="multipart/form-data" class="text-white m-5" id="demo">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos['nombre'] ?>">
            </div>
            <div class="form-group">
                <label for="numero">Numero:</label>
                <input type="number" class="form-control" id="numero" name="numero" value="<?php echo $datos['numero'] ?>">
            </div>
            <div class="form-group">
                <label for="tipo">Seleccionar tipos:</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option value="<?php echo $datos['id_tipo'] ?>" selected disabled hidden><?php echo ucwords(strtolower($datos['tipo'])) ?></option>
                    <?php
                    echo buscarTipos();
                    ?>
                </select>
            </div>
            <div class="md-form mb-3">
                <label for="desc">Descripcion:</label>
                <textarea id="desc" class="md-textarea form-control" rows="3" name="desc"><?php echo $datos['descripcion'] ?></textarea>
            </div>
            <label for="imagen" class="form-label">Foto del Pokemon</label>
            <input id="imagen" type="file" name="imagen" /><br>
            <div class="row m-1">
                <button type="submit" class="btn btn-primary" name="id" value="<?php echo $datos['id'] ?>">Actualizar</button>
                <a href="index.php" class="ml-auto btn btn-primary">Volver</a>
            </div>
        </form>
    </main>
    <?php
    require_once('recursos/templates/footer.php');
    ?>
</body>

</html>