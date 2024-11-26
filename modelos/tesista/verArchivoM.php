<?php  
    require_once('../../modelos/conexionBD.php');

    class verArchivosM extends ConexionBD{
        public function verArchivosM($autor){
            $cBD = $this->conexion();

            $consulta="SELECT * FROM   `Trabajo_Investigacion` WHERE autor='$autor' ";
            $result=mysqli_query(conexionBD::conexion(),$consulta);

            if($result->num_rows){
                $rows = $result->fetch_array(MYSQLI_NUM);
                $datosC =array();
                  $datosC['Idtesis']=$rows[0];
                  $datosC['titulo']=$rows[2];
                  $datosC['tesis']=$rows[5];
                  $datosC['tipo']=$rows[6];
                  
                return $datosC;
            }
            
        }
    }
?>