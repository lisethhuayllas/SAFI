<?php

session_start();
require_once('../../modelos/conexionBD.php');

class  asesoradosModelo
{
    static public function mostrar_asesoradosM()
    {

        if (isset($_SESSION['DNI-usuario'])) {
            $asesor = $_SESSION['DNI-usuario'];

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


    static public function mostrarAsesoradosM()
    {
        $asesor = $_SESSION['DNI-usuario'];
        $consulta = "SELECT CONCAT(T.Nombre, ' ', T.Apellidos) as asesorado, E.nombre as escuela,T.DNI_asesor,T.DNI
                from Asesor A, tesista T, escuela E 
                where A.DNI=T.DNI_asesor 
                and E.ID_escuela=T.escuela 
                and T.Estado='Activo'
                and T.DNI_asesor='$asesor'";


        $respuesta = mysqli_query(conexionBD::conexion(), $consulta);

        return $respuesta;
    }

    static public function mostrar_detalles_asesoradoM($DNI)
    {
        $asesor = $_SESSION['DNI-usuario'];
        $consulta = " SELECT t.DNI, t.nombre, t.apellidos, t.codigo, t.correo, t.celular, e.nombre AS escuela ,CONCAT(a.nombre,' ', a.apellidos) AS asesor, a.DNI AS DNI_asesor FROM tesista t 
            INNER JOIN escuela e
            ON e.ID_escuela=t.escuela 
            INNER JOIN asesor a 
            ON a.DNI=t.DNI_asesor
            WHERE t.DNI='$DNI'  and A.DNI='$asesor' ";

        $respuesta = mysqli_query(conexionBD::conexion(), $consulta);

        return $respuesta;
    }
}
