<?php
require_once('../controladores/asesor/trabajosC.php');
$resultado = Trabajos_investigacin_controlador::mostrar_asesoradosC();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="estilos/asesor/asesorados.css">
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="cabecera">
        <div class="titulo_modulo">
            <h1>PROYECTOS</h1>
        </div>
    </div>

    <div class="seccion_tabla">
        <table>
            <thead>

                <th>ASESORADO</th>
                <th>TRABAJO DE INVESTIGACIÓN</th>
                <th>PROGRESO</th>
                <th>ARCHIVO</th>

            </thead>

            <tbody>
                <?php
                for ($i = 0; $i < mysqli_num_rows($resultado); $i++) {
                    $asesor = mysqli_fetch_array($resultado);
                ?>
                    <tr>
                        <td><?= $asesor['asesorado'] ?></td>
                        <td><?= $asesor['titulo'] ?></td>
                        <td><?= $asesor['estado'] ?></td>
                        <td><a href='asesor.php?modulo=proyectos&DNI=<?= $asesor['DNI'] ?>' TARGET='_blanc'><i class="fa-solid fa-file-pdf"></i>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>