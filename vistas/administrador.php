<?php
    include('../controladores/control_rutas.php');
    controlRutas::validaRol("administrador");
    require_once('../controladores/datos_usuario_controlador.php');
    require_once('../controladores/administrador/control_modulos.php');
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
                                <a href="administrador.php?modulo=trabajos-investigacion" id="a-trabajos-investigacion">
                                    <i class="fa-solid fa-book icono" id="i-trabajos-investigacion"></i>
                                    <span class="texto-opcion" id="texto-trabajos-investigacion">Proyectos</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="administrador.php?modulo=resoluciones" id="a-resoluciones">
                                    <i class="fa-solid fa-file icono" id="i-resoluciones"></i>
                                    <span class="texto-opcion" id="texto-resoluciones">Resoluciones</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="administrador.php?modulo=tesistas" id="a-tesistas">
                                    <i class="fa-sharp fa-solid fa-graduation-cap icono" id="i-tesistas"></i>
                                    <span class="texto-opcion" id="texto-tesistas">Tesistas</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="administrador.php?modulo=asesores" id="a-asesores">
                                    <i class="fa-solid fa-chalkboard-user icono" id="i-asesores"></i>
                                    <span class="texto-opcion" id="texto-asesores">Asesores</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="administrador.php?modulo=jurados" id="a-jurados">
                                    <i class="fa-solid fa-people-roof icono" id="i-jurados"></i>
                                    <span class="texto-opcion" id="texto-jurados">Jurados</span>
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
                    <?php print_r(datosUsuarioControlador::muestraNombreUsuario());?>
                    </span>

                    <span class="rol">
                        <b>Secretaria</b>
                    </span>
                </div>
                
                <i class="fa-solid fa-circle-user"></i>
            </div>

            <div class="contenido-modulo">
                <?php controlModulos::mostrarModulo();?>
            </div>
        </div>
    </div>

    <script src="../scripts/administrador/principal.js"></script>
</body>
</html>