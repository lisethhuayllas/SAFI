<?php
    require_once('../../modelos/conexionBD.php');

    class asesoresModelo{
        static public function recuperaAsesores($carrera){
            if($carrera=='Todos'){
                $consulta="CALL SP_mostrar_todos_asesores()";

            }else{
                $consulta="CALL SP_mostrar_asesores_por_carrera('$carrera')";
            }
            
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function recuperaAsesoresInput($DNI){
            $consulta="CALL SP_mostrar_asesor_por_DNI('$DNI')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function verificaDatosRepetidos($DNI_viejo, $DNI_nuevo, $correo, $celular, $accion){
            if($accion == 'Añadir'){
                $verificaDNI="CALL SP_verifica_DNI_repetido_asesor('$DNI_nuevo')";
                $verificaCorreo="CALL SP_verifica_correo_repetido_asesor('$correo')";
                $verificaCelular="CALL SP_verifica_celular_repetido_asesor('$celular')";
            
            }elseif($accion == 'Editar'){
                $verificaDNI="CALL SP_verifica_DNI_repetidoII_asesor('$DNI_nuevo', '$DNI_viejo')";
                $verificaCorreo="CALL SP_verifica_correo_repetidoII_asesor('$correo', '$DNI_viejo')";
                $verificaCelular="CALL SP_verifica_celular_repetidoII_asesor('$celular', '$DNI_viejo')";
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

        static public function añadirAsesor($DNI,$contraseña,$nombre,$apellidos,$correo,$celular,$tipo_docente,$escuela){
            $consulta="CALL SP_agregar_asesor('$DNI','$contraseña','$nombre','$apellidos','$correo','$celular','$tipo_docente',$escuela, 'Laborando')";
            
            return mysqli_query(conexionBD::conexion(),$consulta);
        }

        static public function recuperaDetallesAsesor($DNI){
            $consulta="CALL SP_mostrar_detalles_asesor('$DNI')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

            return $respuesta;
        }

        static public function actualizaInformacionAsesor($nombre,$apellidos,$DNIviejo,$DNInuevo,$escuela,$correo,$celular,$tipo_docente){
            $consulta="CALL SP_actualizar_informacion_asesor('$nombre', '$apellidos', '$DNIviejo', '$DNInuevo', $escuela, '$correo', '$celular', '$tipo_docente')";

            return mysqli_query(conexionBD::conexion(),$consulta);
        }
    }
?>