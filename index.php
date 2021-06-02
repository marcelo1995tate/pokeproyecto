<?php
require_once('paginas/buscar.php');
session_start();

$logeado = isset($_SESSION['usuario']);

if (isset($_GET['buscar']))
    $datos = mostrar_pokemon($_GET['buscar'], $logeado);
else
    $datos = mostrar_todos($logeado);
?>
<!doctype html>
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

<body class="bg-dark">
    <?php
    if ($logeado)
        require_once('recursos/templates/headerLogueado.php');
    else
        require_once('recursos/templates/header.php');
    ?>

    <main>


        <form class="input-group" method="GET">
            <input type="search" name="buscar" class="form-control rounded m-3" placeholder="Buscar" aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-primary mr-3 my-3">
                <i class="fas fa-search"></i></button>
        </form>

        <?php
        if (isset($_SESSION['error']))
            echo "<div class=\"alert alert-danger mx-3\" role=\"alert\">$_SESSION[error]</div>"
        ?>

        <?php
        if ($logeado)
            echo '<div class="input-group"><button type="submit" data-toggle="collapse" data-target="#demo" class="btn btn-block btn-outline-info m-3">Agregar Pokemon</button></div>';
        require_once('recursos/templates/formularioAM.php');
        ?>

        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead class="text-center">
                    <?php
                    echo obtenerCabeceras($logeado);
                    ?>
                </thead>
                <tbody class="text-center">
                    <?php
                        echo $datos;
                    ?>
                </tbody>
            </table>
        </div>


    </main>
    <?php
    require_once('recursos/templates/footer.php');
    ?>
</body>

</html>
<?php unset($_SESSION['error']); ?>