<?php  
    require_once('../modelos/conexionBD.php');

    class verFechasM extends ConexionBD{

        public function revisionM ($idTesis){
            $cBD = $this->conexion();

            $consulta="SELECT * from  `revision` WHERE trabajo_revisado= '$idTesis'";
           
            $result=mysqli_query(conexionBD::conexion(),$consulta);

            if($result->num_rows){
                $rows = $result->fetch_array(MYSQLI_NUM);
                return $rows;
            }

        } 
      
        public function sustentarM ($idTesis){
            $cBD = $this->conexion();
            $consulta="SELECT * from  `sustentacion` WHERE proyecto= '$idTesis'";
           
            $result=mysqli_query(conexionBD::conexion(),$consulta);

            if($result->num_rows){
                $rows = $result->fetch_array(MYSQLI_NUM);
                return $rows;
            }

           
        }
    
    }
?>
