<form action="paginas/cargarPokemon.php" method="POST" enctype="multipart/form-data" class="text-white was-validated collapse m-3" id="demo">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="id">Numero:</label>
        <input type="number" class="form-control" id="id" name="id" required>
    </div>
    <div class="form-group">
        <label for="tipo">Seleccionar tipos:</label>
        <select class="form-control" id="tipo" name="tipo">
            <option value="" selected disabled hidden>Tipos</option>
            <?php
            echo buscarTipos();
            ?>
        </select>
    </div>
    <div class="md-form">
        <label for="desc">Descripcion:</label>
        <textarea id="desc" class="md-textarea form-control" rows="3" name="desc"></textarea>
    </div>
    <label for="imagen" class="form-label">Foto del Pokemon</label>
    <input id="imagen" type="file" name="imagen" /><br>
    <button type="submit" class="btn btn-primary">Cargar</button>
</form>