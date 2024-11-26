<?php
    require_once('../../modelos/conexionBD.php');

    class resolucionesModelo{
        static public function recuperaDatosResoluciones($filtrado , $numeroResolucion){
            if($filtrado == "Sin filtro"){
                $consulta="CALL SP_mostrar_resoluciones()";
            }else{
                $consulta="CALL SP_mostrar_resoluciones_filtrado('$numeroResolucion')";
            }

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            
            return $respuesta;            
        }

        static public function buscarResolucionValidar($numeroResolucion){
            $consulta="CALL SP_buscar_resolucion_validar('$numeroResolucion')";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            
            return mysqli_num_rows($respuesta);            
        }

        static public function buscarResolucionValidarEditando($numeroResolucion, $numeroResolucionNuevo){
            $consulta="CALL SP_buscar_resolucion_validar_editando('$numeroResolucion', '$numeroResolucionNuevo')";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            
            return mysqli_num_rows($respuesta);            
        }

        static public function agregarResolucion($numeroResolucion, $tipoResolucion, $archivo, $autor){
            $archivoLimpio = mysqli_escape_string(conexionBD::conexion(), $archivo);
            $consulta="CALL SP_agregar_resolucion('$numeroResolucion', '$tipoResolucion', '$archivoLimpio', '$autor')";
            
            mysqli_query(conexionBD::conexion(),$consulta);
        }

        static public function editarResolucion($numeroResolucion, $numeroResolucionNuevo, $tipoResolucion, $archivo, $autor, $archivoModificado){
            if($archivoModificado){
                $archivoLimpio = mysqli_escape_string(conexionBD::conexion(), $archivo);
                $consulta="CALL SP_editar_resolucion_archivo('$numeroResolucion', '$numeroResolucionNuevo','$tipoResolucion', '$archivoLimpio', '$autor')";

            }else{
                $consulta="CALL SP_editar_resolucion_datos('$numeroResolucion', '$numeroResolucionNuevo', '$tipoResolucion', '$autor')";
            }

            mysqli_query(conexionBD::conexion(),$consulta);
        }

        static public function recuperarPDF($numeroResolucion){
            $consulta="CALL SP_mostrar_archivo('$numeroResolucion')";

            return mysqli_query(conexionBD::conexion(),$consulta);
        }
    }
?>