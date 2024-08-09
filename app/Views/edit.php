<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Casa</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/styl.css') ?>">
</head>
<body>
    <div class="form-container">
        <h1>Editar Casa</h1>
        <form action="<?= base_url('casas/update/' . $casa['id_casa']) ?>" method="post">
            <input type="hidden" name="id_direccion" value="<?= $casa['id_direccion'] ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= $casa['nombre_casa'] ?>" required><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= $casa['direccion'] ?>" required><br>

            <label for="barrio">Barrio:</label>
            <input type="text" id="barrio" name="barrio" value="<?= $casa['barrio'] ?>" required><br>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?= $casa['ciudad'] ?>" required><br>

            <button type="submit">Actualizar Casa</button>
        </form>
    </div>
</body>
</html>