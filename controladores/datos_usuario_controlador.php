<?php
    require_once('../modelos/datos_usuario_modelo.php');
    
    class datosUsuarioControlador{
        static public function muestraNombreUsuario(){
            return datosUsuarioModelo::recuperaNombreUsuario($_SESSION['DNI-usuario'],$_SESSION['rol-usuario'])['datos'];
        }
        static public function dobleUsuario($DNI){
            return datosUsuarioModelo::DobleUsuario($DNI);
        }
    }
?>