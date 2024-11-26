<?php
    include('../controladores/control_rutas.php');

    controlRutas::validaRol("jurado");
    require_once('../controladores/datos_usuario_controlador.php');
    require_once('../controladores/jurado/modulo_jurado.php');
    /* hola*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFI - UNAJMA</title>

    <link rel="stylesheet" href="estilos/jurado/menuJ.css">
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
                            <span class="nombre">Secretaría Academica</span>
                            <span class="nombre">Facultad de Ingeniería</span>
                        </div>
                    </div>
                </header>

                <div class="opciones">
                    <div class="opciones-principales">
                        <ul>
                            <li>
                                <a href="jurado.php?modulo=inicio" id="a-inicio">
                                    <i class="fa-solid fa-house icono" id="i-inicio"></i>
                                    <span class="texto-opcion" id="texto-inicio">Inicio</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="jurado.php?modulo=roles" id="j-roles">
                                    <i class="fa-solid fa-users icono" id="i-roles"></i>
                                    <span class="texto-opcion" id="texto-roles">Roles</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="jurado.php?modulo=presentacion" id="j-tesis">
                                    <i class="fa-solid fa-file icono" id="i-tesis"></i>
                                    <span class="texto-opcion" id="texto-tesis">Perfil de proyecto</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="jurado.php?modulo=sustentacion" id="j-sustentacion">
                                    <i class="fa-solid fa-book-bookmark icono" id="i-sustentacion"></i>
                                    <span class="texto-opcion" id="texto-sustentacion">Informe de tesis</span>
                                </a>
                            </li>
                        </ul>
                        <!-- <ul>
                            <li>
                                <a href="jurado.php?modulo=calificar" id="j-calificar">
                                    <i class="fa-solid fa-file-circle-check icono" id="i-calificar"></i>
                                    <span class="texto-opcion" id="texto-calificar">Calificación</span>
                                </a>
                            </li>
                        </ul> -->

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
                        <?php print_r(datosUsuarioControlador::muestraNombreUsuario());?>
                    </span>

                    <span class="rol">
                        <b>Jurado</b>
                    </span>
                </div>
                
                <i class="fa-solid fa-circle-user"></i>
            </div>

            <div class="contenido-modulo">
                <?php controlModulos::mostrarModulo();?>
            </div>
        </div>

    </div>   
</body>
</html>