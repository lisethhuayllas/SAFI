<?php  
    require_once('../modelos/conexionBD.php');

    class verArchivosM extends ConexionBD{
       
        public function verEstudianteM($autor){
            $cBD = $this->conexion();

            $consulta="SELECT  `nombre`, `apellidos` FROM   `tesista` WHERE DNI='$autor' ";
            $result=mysqli_query(conexionBD::conexion(),$consulta);

            if($result->num_rows){
                $rows = $result->fetch_array(MYSQLI_NUM);
                $nombre=$rows[0];
                $apellido=$rows[1];
                $dato="$nombre"." "."$apellido";
                return $dato;
            }
            
        }

    }
?>