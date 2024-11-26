<?php
    require_once('../modelos/conexionBD.php');
    
    class indexModelo{
        static public function validar_usuario($DNI){
            $consulta="SELECT rol,contrasenia from usuarios where DNI='$DNI'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta->fetch_array(MYSQLI_ASSOC);
        }

        static public function validar_usuario_recuperacion($DNI){
            $consulta="SELECT correo,rol from usuarios where DNI='$DNI'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta->fetch_array(MYSQLI_ASSOC);
        }

        static public function cambiar_contrasenia($DNI,$rol,$contrasenia){
            $consulta="UPDATE $rol SET contrasenia='$contrasenia' where DNI='$DNI'";
            mysqli_query(conexionBD::conexion(),$consulta);
        }
        static public function contar_perfil($DNI){
            $consulta="SELECT COUNT(rol) AS 'perfil' FROM usuarios WHERE DNI='$DNI'";
            $res=mysqli_query(conexionBD::conexion(),$consulta);

            return $res->fetch_array(MYSQLI_ASSOC);
        }
    }
?>