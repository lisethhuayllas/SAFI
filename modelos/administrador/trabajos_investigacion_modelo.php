<?php
    require_once('../../modelos/conexionBD.php');

    class trabajosInvestigacionModelo{
        static public function recuperaTrabajosInvestigacion(){
            $consulta="CALL SP_mostrar_trabajos_investigacion()";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function buscaTrabajosInvestigacion($texto){
            $consulta="CALL SP_buscar_trabajos_investigacion('$texto')";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function recuperaPDFTrabajoInvestigacion($IDproyecto){
            $consulta="CALL SP_mostrar_trabajo_investigacion($IDproyecto)";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function cambiarEstadoProyecto($IDproyecto, $nuevoEstado){
            $consulta="CALL SP_cambiar_estado_proyecto($IDproyecto, '$nuevoEstado')";
            mysqli_query(conexionBD::conexion(),$consulta);
        }
    }
?>