<form action="paginas/cargarPokemon.php" method="POST" enctype="multipart/form-data" class="text-white collapse mx-5 mb-2" id="demo">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="numero">Numero:</label>
        <input type="number" class="form-control" id="numero" name="numero" required>
    </div>
    <div class="form-group">
        <label for="tipo">Seleccionar tipos:</label>
        <select class="form-control" id="tipo" name="tipo" required>
            <option value="" selected disabled hidden>Tipos</option>
            <?php
            echo buscarTipos();
            ?>
        </select>
    </div>
    <div class="md-form mb-3">
        <label for="desc">Descripcion:</label>
        <textarea id="desc" class="md-textarea form-control" rows="3" name="desc" required></textarea>
    </div>
    <label for="imagen" class="form-label">Foto del Pokemon</label>
    <input id="imagen" type="file" name="imagen" required/><br>
    <button type="submit" class="btn btn-primary mt-3">Cargar</button>
</form>