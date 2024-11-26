<?php
    require_once('../modelos/conexionBD.php');

    class datosUsuarioModelo{
        static public function recuperaNombreUsuario($DNI,$rol){
            $consulta="SELECT CONCAT(nombre,' ', apellidos) AS datos FROM $rol WHERE DNI='$DNI'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta->fetch_array(MYSQLI_ASSOC);
        }
        static public function DobleUsuario($DNI){
            $consulta="SELECT CONCAT(nombre,' ', apellidos) AS datos FROM asesor WHERE DNI='$DNI'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }
    }
?>