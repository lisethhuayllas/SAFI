<?php
    class conexionBD{
        static public function conexion(){
            $servidor="localhost";
            $baseDeDatos="safi_unajma";
            $usuario="root";
            $contrasenia="";

            $conexion=new mysqli($servidor,$usuario,$contrasenia,$baseDeDatos);
            mysqli_set_charset($conexion, "utf8mb4");

            return $conexion;
        }
    }
?>