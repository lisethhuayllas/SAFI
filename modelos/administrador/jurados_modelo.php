<?php
    require_once('../../modelos/conexionBD.php');

    class juradosModelo{
        static public function recuperaJurados($carrera){
            if($carrera=='Todos'){
                $consulta="CALL SP_mostrar_todos_jurados()";

            }else{
                $consulta="CALL SP_mostrar_jurados_por_carrera('$carrera')";
            }
            
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function recuperaJuradosInput($DNI){
            $consulta="CALL SP_mostrar_jurado_por_DNI('$DNI')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function añadirJurado($DNI,$contraseña,$nombre,$apellidos,$correo,$celular,$escuela){
            $consulta="CALL SP_agregar_jurado('$DNI','$contraseña','$nombre','$apellidos','$correo','$celular',$escuela, 'Laborando')";
            
            return mysqli_query(conexionBD::conexion(),$consulta);
        }

        static public function recuperaDetallesJurado($DNI){
            $consulta="CALL SP_mostrar_detalles_jurado('$DNI')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function actualizaInformacionJurado($nombre,$apellidos,$DNIviejo,$DNInuevo,$escuela,$correo,$celular){
            $consulta="CALL SP_actualizar_informacion_jurado('$nombre', '$apellidos', '$DNIviejo', '$DNInuevo', $escuela, '$correo', '$celular')";

            return mysqli_query(conexionBD::conexion(),$consulta);
        }

        static public function verificaDatosRepetidos($DNI_viejo, $DNI_nuevo, $correo, $celular, $accion){
            if($accion == 'Añadir'){
                $verificaDNI="CALL SP_verifica_DNI_repetido_jurado('$DNI_nuevo')";
                $verificaCorreo="CALL SP_verifica_correo_repetido_jurado('$correo')";
                $verificaCelular="CALL SP_verifica_celular_repetido_jurado('$celular')";
            
            }elseif($accion == 'Editar'){
                $verificaDNI="CALL SP_verifica_DNI_repetidoII_jurado('$DNI_nuevo', '$DNI_viejo')";
                $verificaCorreo="CALL SP_verifica_correo_repetidoII_jurado('$correo', '$DNI_viejo')";
                $verificaCelular="CALL SP_verifica_celular_repetidoII_jurado('$celular', '$DNI_viejo')";
            }  

            if (mysqli_num_rows(mysqli_query(conexionBD::conexion(),$verificaDNI)) != 0){
                return "DNI existe";

            }else if(mysqli_num_rows(mysqli_query(conexionBD::conexion(),$verificaCorreo)) != 0){
                return "Correo existe";

            }else if(mysqli_num_rows(mysqli_query(conexionBD::conexion(),$verificaCelular)) != 0){
                return "Celular existe";

            }

            return;
        }
    }
?>