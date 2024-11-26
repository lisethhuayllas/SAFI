<?php
    require_once('../../modelos/conexionBD.php');

    class tesistasModelo{
        static public function añadirTesista($DNI,$contraseña,$nombre,$apellidos,$codigo,$correo,$celular,$escuela,$DNI_asesor){
            $consulta="CALL SP_agregar_tesista('$DNI','$contraseña','$nombre','$apellidos','$codigo','$correo','$celular',$escuela,'$DNI_asesor')";
            
            return mysqli_query(conexionBD::conexion(),$consulta);
        }

        static public function recuperaTesistasInput($DNI){
            $consulta="CALL SP_mostrar_tesista_por_DNI('$DNI')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function recuperaAsesoresEscuela($escuelaProfesional){
            $consulta="CALL SP_mostrar_asesores_escuela('$escuelaProfesional')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function recuperaTesistas($carrera){
            if($carrera=='Todos'){
                $consulta="CALL SP_mostrar_todos_tesistas()";

            }else{
                $consulta="CALL SP_mostrar_tesistas_por_carrera('$carrera')";
            }
            
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function recuperaDetallesTesista($DNI){
            $consulta="CALL SP_mostrar_detalles_tesista('$DNI')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function actualizaInformacionTesista($nombre,$apellidos,$DNIviejo,$DNInuevo,$codigo,$escuela,$correo,$celular,$asesor){
            $consulta="CALL SP_actualizar_informacion_tesista('$nombre', '$apellidos', '$DNIviejo', '$DNInuevo', '$codigo', $escuela, '$correo', '$celular', '$asesor')";

            return mysqli_query(conexionBD::conexion(),$consulta);
        }

        static public function verificaDatosRepetidos($DNI_viejo, $DNI_nuevo, $codigo, $correo, $celular, $accion){
            if($accion == 'Añadir'){
                $verificaDNI="CALL SP_verifica_DNI_repetido('$DNI_nuevo')";
                $verificaCodigo="CALL SP_verifica_codigo_repetido('$codigo')";
                $verificaCorreo="CALL SP_verifica_correo_repetido('$correo')";
                $verificaCelular="CALL SP_verifica_celular_repetido('$celular')";
            
            }elseif($accion == 'Editar'){
                $verificaDNI="CALL SP_verifica_DNI_repetidoII('$DNI_nuevo', '$DNI_viejo')";
                $verificaCodigo="CALL SP_verifica_codigo_repetidoII('$codigo', '$DNI_viejo')";
                $verificaCorreo="CALL SP_verifica_correo_repetidoII('$correo', '$DNI_viejo')";
                $verificaCelular="CALL SP_verifica_celular_repetidoII('$celular', '$DNI_viejo')";
            }  

            if (mysqli_num_rows(mysqli_query(conexionBD::conexion(),$verificaDNI)) != 0){
                return "DNI existe";

            }else if(mysqli_num_rows(mysqli_query(conexionBD::conexion(),$verificaCodigo)) != 0){
                return "Código existe";

            }else if(mysqli_num_rows(mysqli_query(conexionBD::conexion(),$verificaCorreo)) != 0){
                return "Correo existe";

            }else if(mysqli_num_rows(mysqli_query(conexionBD::conexion(),$verificaCelular)) != 0){
                return "Celular existe";

            }

            return;
        }
    }
?>