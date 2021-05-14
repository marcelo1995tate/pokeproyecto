<?php
require_once("paginas/detalle-pokemon.php");
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokedex</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
    <main class="bg-dark text-white p-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-5 col-lg-5 text-center">
                    <?php
                    buscarPokemonImagen($datos);
                    ?>
                </div>
                <div class="col-12 col-sm-12 col-md-7 col-lg-7 text-center">
                    <div class="col-12 col-sm-12 col-lg-12 text-center row">
                        <div class="col-12 col-sm-12 col-lg-6 text-center">
                            <?php
                            buscarPokemontipo($datos);
                            ?>
                        </div>
                        <div class="col-12 col-sm-12 col-lg-6 text-center">
                            <?php
                            buscarPokemonnombre($datos);
                            ?>
                        </div>
                    </div>
                    <?php
                    buscarPokemondescripcion($datos);
                    ?>
                </div>

            </div>

        </div>
    </main>

    <?php
    include_once("recursos/templates/footer.php");
    ?>
</body>

</html>