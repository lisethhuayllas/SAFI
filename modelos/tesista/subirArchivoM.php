<?php  
    require_once('../modelos/conexionBD.php');

    class archivosM extends ConexionBD{

        public function guardarArchivosM($datosC){
            $cBD = $this->conexion();

            $titulo=  $datosC['tituloT'];
            $tesis= $datosC['imagenBinario'];
            $binario= mysqli_escape_string(conexionBD::conexion(),$tesis) ; // limpiar binario     
            $autor=  $datosC['autorT'];
            $tipo= $datosC['tipoT'];
            $fecha= date('Y-m-d');
            $estado="inicio";
            $consulta="INSERT INTO `Trabajo_Investigacion` 
            VALUES(null,'$autor','$titulo','$fecha','$estado','$binario','$tipo')";
           
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
           
            return $respuesta;   
            
        } 

        public function editarArchivosM($datosC){
            $titulo=  $datosC['tituloE'];
            $tesis= $datosC['tesisBinario'];
            $binario= mysqli_escape_string(conexionBD::conexion(),$tesis) ; // limpiar binario     
            $autor=  $datosC['autorE'];
            $tipo= $datosC['tipoE'];
            $idTesis= $datosC['IdtesisE'];
          
        
            $consulta="UPDATE `Trabajo_Investigacion` SET  titulo='$titulo',tipo='$tipo', archivo='$binario' 
            WHERE ID_proyecto='$idTesis' and autor='$autor' ";
           
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta; 
        } 

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
        
    //------------------------------FUNCION limpieza-------------------------------------
        public function limpieza( $string)
        {   
            $cBD = $this->conexion();
             return htmlentities($cBD->real_escape_string($string));
        }

    }
?>