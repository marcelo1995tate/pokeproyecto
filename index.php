<?php
require_once('paginas/buscar.php');
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/cd9f94a914.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Pokedex</title>
</head>

<body>
    <?php
    if (isset($_SESSION['usuario']))
        require_once('recursos/templates/headerLogueado.php');
    else
        require_once('recursos/templates/header.php');

    if(isset($_GET['exit'])){
        switch($_GET['exit']){
            case 0:
                echo "Usuario o contrasenia incorrectos";
        }
    }
    ?>
    <main>
        <form class="input-group rounded" action="" method="GET">
            <input type="search" name="buscar" class="form-control rounded" placeholder="Buscar" aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i></button>
        </form>
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_GET['buscar']))
                    echo mostrar_todos();
                else
                    echo mostrar_pokemon($_GET['buscar']);

                ?>
            </tbody>
        </table>

    </main>
    <?php
    require_once('recursos/templates/footer.php');
    ?>
</body>

</html>