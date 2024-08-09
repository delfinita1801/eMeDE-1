<!DOCTYPE html>
<html>
<head>
    <title>Panel</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/estilo.css') ?>">
</head>
<body>
    <h2>Bienvenido, <?= session()->get('Nombre') ?> <?= session()->get('Apellido') ?></h2>
    <a href="<?= site_url('logout') ?>">Cerrar Sesión</a>

    <h3>Consumo de Energía</h3>
    <table border="1">
        <tr>
            <th>Casa</th>
            <th>Energía (Wh)</th>
            <th>Tiempo (h)</th>
            <th>Fecha de Registro</th>
        </tr>
        <?php foreach($consumos as $consumo): ?>
            <tr>
                <td>
                    <?php
                        foreach($dispositivos as $dispositivo) {
                            if ($dispositivo['d_dispositivo'] == $consumo['id_dispositivo']) {
                                echo $dispositivo['nombre_dispositivo'];
                                break;
                            }
                        }
                    ?>
                </td>
                <td><?= $consumo['Energia'] ?></td>
                <td><?= $consumo['Tiempo'] ?></td>
                <td><?= $consumo['fecha_registro'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
