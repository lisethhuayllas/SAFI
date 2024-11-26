<?php
    include('../controladores/control_rutas.php');

    controlRutas::validaRol("estudiante");

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
                                <a href="tesista.php?modulo=miasesor" class="opcion">
                                    <i class="fa-solid fa-user-tie icono "  id="miasesor"></i>
                                    <span class="texto-opcion" id="texto-inicio">MI ASESOR</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                            <a href="tesista.php?modulo=subirArchivo" class="opcion">
                                    <i class="fa-sharp fa-solid fa-file-arrow-up icono" id="archivo" ></i>
                                    <span class="texto-opcion" id="texto-tesistas">SUBIR ARCHIVO</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                            <a href="tesista.php?modulo=verJurados" class="opcion">
                                    <i class="fa-solid fa-users-line icono"  id="misjurados"></i>
                                    <span class="texto-opcion" id="texto-tesistas">MIS JURADOS</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                            <a href="tesista.php?modulo=verfechas" class="opcion">
                                    <i class="fa-sharp fa-solid fa-calendar-days icono"  id="avances"></i>
                                    <span class="texto-opcion" id="texto-tesistas">SUSTENTACION</span>
                                </a>
                            </li>
                        </ul>

                        <ul>
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
                        <?php  
                          require_once('../controladores/tesista/verEstudianteC.php');
                          $datosC = new verEstudianteC();
                          $nombre= $datosC->verEstudianteC();
                          echo "$nombre";
                       ?>
                    </span>

                    <span class="rol">
                        <b>Estudiante</b>
                    </span>
                </div>
                
                <i class="fa-solid fa-circle-user"></i>
            </div>

            <div class="contenido-modulo">
                <?php 
                include ('../controladores/tesista/modulo_tesista.php');
                ?>

            </div>
        </div>
    </div>

</body>
</html>