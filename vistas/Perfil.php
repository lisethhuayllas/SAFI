<?php
include('../controladores/control_rutas.php');
require_once('../controladores/datos_usuario_controlador.php');
controlRutas::validaRol("perfil");

$contrasenia = $_SESSION['contrasenia-usuario'];
$DNI = $_SESSION['DNI-usuario'];
$datos = datosUsuarioControlador::dobleUsuario($DNI);
$nombre = mysqli_fetch_array($datos);
$name = $nombre['datos'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFI - UNAJMA</title>

    <link rel="stylesheet" href="estilos/opcion_2_roles.css">
    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form id="contact" method="post" action="../controladores/index_controlador.php">
            <input type="hidden" id="username" name="username" value="<?= $DNI ?>">
            <input type="hidden" id="password" name="password" value="<?= $contrasenia ?>">
            <h3>Hola <?php echo ($name) ?> </h3>
            <h4>Quieres acceder como jurado o asesor?</h4>

            <fieldset><label for="rol">Selecciona el Rol:</label></fieldset>
            <fieldset><select id="rol" name="rol">
                    <option value="jurado">Jurado</option>
                    <option value="asesor">Asesor</option>
                </select></fieldset>
            <fieldset>
                <button type="submit" id="contact-submit" value="Enviar">Ingresar</button>
            </fieldset>
        </form>
    </div>
</body>

</html>