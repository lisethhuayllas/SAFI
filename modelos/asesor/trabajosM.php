<?php
require_once('../modelos/conexionBD.php');

class Trabajos_investigacin_modelo
{
    static public function ver_trabajoM($dniasesorado)
    {
        if (isset($_SESSION['DNI-usuario'])) {
            $asesor = $_SESSION['DNI-usuario'];

            $consulta = "SELECT  T.DNI as dni_tesista , CONCAT(T.Nombre, ' ', T.Apellidos) as asesorado, A.DNI as dni_asesor, TI.archivo
         from Asesor A, tesista T, trabajo_investigacion TI, escuela E
        where 
        A.DNI=T.DNI_asesor 
        and T.DNI=TI.autor 
        and A.DNI='$asesor'
        and T.DNI='$dniasesorado'";

            $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
            return  $respuesta;
        }
    }

    static public function mostrar_asesoradosM()
    {

        if (isset($_SESSION['DNI-usuario'])) {
            $asesor = $_SESSION['DNI-usuario']; //DNI de asesor en sesión 

            $consulta = "SELECT CONCAT(T.Nombre, ' ', T.Apellidos) as asesorado, TI.estado, TI.titulo, T.DNI_asesor,T.DNI
            from Asesor A, tesista T, trabajo_investigacion TI
            where 
            A.DNI=T.DNI_asesor 
            and T.DNI=TI.autor 
            and T.Estado='Activo'
            and T.DNI_asesor='$asesor'";

            $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
            return  $respuesta;
        }
    }
}
