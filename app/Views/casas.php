<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Casas</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/styl.css') ?>">
</head>
<body>
    <div class="container">
        <h1>Casas</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Consumo</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Barrio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($casas) && !empty($casas)): ?>
                    <?php foreach ($casas as $casa): ?>
                        <tr>
                            <td><?= $casa['id_casa'] ?></td>
                            <td><?= $casa['nombre_casa'] ?></td>
                            <td><?= $casa['consumo'] ?></td>
                            <td><?= $casa['calle'] . ' ' . $casa['numero'] ?></td>
                            <td><?= $casa['nombre_ciudad'] ?></td>
                            <td><?= $casa['nombre_barrio']?></td>
                            <td>
                                <a href="<?= base_url('casas/delete/' . $casa['id_casa']) ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta casa?');">X</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay casas disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='<?= base_url('casas/create') ?>'">Agregar Casa</button>
    </div>
</body>
</html>