<?php  
    require_once('../modelos/conexionBD.php');

    class verAsesorJuradoM extends ConexionBD{

        public function miAsesorM ($autor){
            $cBD = $this->conexion();

            $consulta="SELECT DNI_asesor from  `tesista` WHERE DNI= '$autor'";
           
            $result=mysqli_query(conexionBD::conexion(),$consulta);

            if($result->num_rows){
                $rows = $result->fetch_array(MYSQLI_NUM);
                 $asesorId=$rows[0];
                 
                 $consulta="SELECT * from  `asesor`  WHERE DNI= '$asesorId'";
               
                $result=mysqli_query(conexionBD::conexion(),$consulta);
                   
                if($result->num_rows){
                    $rows = $result->fetch_array(MYSQLI_NUM);
                    return $rows ;
                }

            }
        } 
      
        public function juradoM ($idTesis){
            $cBD = $this->conexion();

            $consulta="SELECT * FROM `tipo_jurado` WHERE proyecto= '$idTesis'";
           
            $result=mysqli_query(conexionBD::conexion(),$consulta);
             
            if($result->num_rows){
                $datosC =array(); 

                for($i=0;$i< $result->num_rows ; $i++){
                    $rows = $result->fetch_array(MYSQLI_NUM);
                    $DNI= $rows[0];  $cargo= $rows[2]; 
                        $consulta="SELECT * FROM `jurado` WHERE DNI= '$DNI'";
                        $result1=mysqli_query(conexionBD::conexion(),$consulta);
                        $rows1 = $result1->fetch_array(MYSQLI_NUM);
                           $datosC["$i"]["nombre"]=$rows1[2];
                           $datosC["$i"]["apellido"]=$rows1[3];
                           $datosC["$i"]["correo"]=$rows1[4];
                           $datosC["$i"]["telefono"]=$rows1[5];
                           $datosC["$i"]["estado"]=$rows1[7]; 
                           $datosC["$i"]["cargo"]=$cargo;    
                }
                return  $datosC ;
                
            }
           
        }

        /*
        public function jurado1M ($idTesis){
            $cBD = $this->conexion();

            $consulta="SELECT * FROM `tipo_jurado` WHERE proyecto= '$idTesis'";
           
            $result=mysqli_query(conexionBD::conexion(),$consulta);
             
            if($result->num_rows){
                $rows = $result->fetch_array(MYSQLI_NUM);
                foreach( $result as $tarea):
                  //  var_dump($tarea) ;
                    foreach(  $tarea as  $valor):
                        $s= $valor;
                        $consulta="SELECT * FROM `jurado` WHERE DNI= '$s'";
                        $result=mysqli_query(conexionBD::conexion(),$consulta);
                         return $result;
                      //  echo  "<br>"; 
                    endforeach; 
                endforeach;
               // echo $rows[0][7];
               //echo $rows[1][6];
               /*
               foreach(  $rows as $tarea => $valor):
                echo $valor;
              //  echo $tarea[0][0];
             //  var_dump($tarea) ;
                
              // return $tarea;
            endforeach; 
              // var_dump($rows) ;
                foreach(  $rows as $tarea => $valor):
                    echo $valor;
                    
                  //  echo $tarea[0][0];
                 //  var_dump($tarea) ;
                    
                  // return $tarea;
                endforeach; 
               // for( $i= 0; $i< $rows; $i++){
                  
                  // echo $asesorId;
                   //echo "<br>";
                  // echo $idTesis;
               // }
                 //  return  $asesorId;


                  for($i=0; $i<4; $i++){  echo $i; echo "<br>";
                  echo  $datosC["$i"]["nombre"];
                  echo  $datosC["$i"]["apellido"];
                  echo  $datosC["$i"]["telefono"];
                  echo  $datosC["$i"]["correo"];
                  echo  $datosC["$i"]["estado"];
                  echo "<br>";
                }

            // return  $result;

            }  
        } 

   */
    
    }
?>



