<?php
include('../controladores/control_rutas.php');

controlRutas::validaRol("asesor");

require_once('../controladores/asesor/control_modulos_asesor.php');
require_once('../controladores/datos_usuario_controlador.php');
?>

<!DOCTYPE html>
<html lang="es" class="pagina_html">

<head>
    <meta charset="UTF-8">
    <title>SAFI - UNAJMA</title>

    <link rel="stylesheet" href="estilos/menu.css">

    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="contenedor-general">
        <div class="seccion-menu">
            <nav class="menu-lateral">
                <header>
                    <div class="logo-texto">
                        <span class="logo">
                            <img src="../assets/logo-SAFI.png" alt="Logo SAFI - UNAJMA">
                        </span>

                        <div class="texto">
                            <span class="nombre">Secretaría General</span>
                            <span class="nombre">Facultad de Ingeniería</span>
                        </div>
                    </div>
                </header>

                <div class="opciones">
                    <div class="opciones-principales">
                        <ul>
                            <li>
                            
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="asesor.php?modulo=asesorados" class="opcion">
                                    <i class="fa-sharp fa-solid fa-graduation-cap icono"></i>
                                    <span class="texto-opcion" id="texto-tesistas">ASESORADOS</span>
                                </a>
                            </li>
                        </ul>


                        <ul>
                            <li>
                                <a href="asesor.php?modulo=avances_proyectos" class="opcion">
                                    <i class="fa-solid fa-book icono"></i>
                                    <span class="texto-opcion" id="texto-tesistas">PROYECTOS</span>
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="opcion-salir">
                        <li>
                            <a href="../controladores/cerrar_sesion.php">
                                <i class="fa-solid fa-right-from-bracket icono"></i>
                                <span class="texto-opcion">Salir</span>
                            </a>
                        </li>
                    </div>
                </div>
            </nav>
        </div>


        <div class="contenido">
            <div class="encabezado-datos">
                <div class="datos">
                    <span class="nombre">
                        <?php print_r(datosUsuarioControlador::muestraNombreUsuario()); ?>
                    </span>

                    <span class="rol">
                        <b>Asesor</b>
                    </span>
                </div>

                <i class="fa-solid fa-circle-user"></i>
            </div>

            <div class="contenido-modulo">
                <?php controlModulos::mostrarModulo(); ?>
            </div>
        </div>
    </div>

    <script src="../scripts/administrador/principal.js"></script>
</body>

</html>