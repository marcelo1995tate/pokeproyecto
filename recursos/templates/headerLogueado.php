<header>
    <nav class="container">
        <div class="row align-items-center">

            <img style="width: 100px; height: 100px;" src="recursos/imagenes/logo.png">
            <!--Logo-->

            <h1 class="navbar-brand" href="#">Pokedex</h1>
            <!--User-->
            <a class="ml-auto btn btn-primary mb-2" href="http://localhost/pokeproyecto/paginas/login.php?logout=true">Cerrar Sesión</a>

            <h2><?php $_SESSION['usuario'] ?></h2>
        </div>
    </nav>
</header>