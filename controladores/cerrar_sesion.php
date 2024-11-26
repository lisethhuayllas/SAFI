<?php
    session_start();
    
    class cerrarSesion{
        static public function cerrar_sesion(){
            session_start();
            session_destroy();

            header('location: ../index.php');
        }
    }

    cerrarSesion::cerrar_sesion();
?>