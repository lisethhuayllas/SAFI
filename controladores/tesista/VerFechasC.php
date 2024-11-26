<?php
   // session_start(); 
   require_once('../modelos/tesista/verFechasM.php');
 
   
    class verFechasC{
        function __construct(){
            $this->fechasM = new verFechasM();
        }

         public function revisionC($idTesis){
          
            $resultado = $this->fechasM->revisionM($idTesis);
            return $resultado;
           
         }

         public function sustentarC($idTesis){
            $resultado = $this->fechasM->sustentarM($idTesis);
            
            $fechaActual = date('Y-m-d');
            if ($resultado){
                 $ProxFecha = $resultado[2];
                 $dateDifference = abs(strtotime($resultado[2]) - strtotime($fechaActual));

                 $years  = floor($dateDifference / (365 * 60 * 60 * 24));
                 $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                 $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));

                 $tiempoRes= $years." years, ".$months." months and ".$days." days";
                 $datosC =array(); 
                 $datosC["Datos"]= $resultado;
                 $datosC["TiempoRestante"]= $tiempoRes;
                 $datosC["hoy"]= $fechaActual;


              return $datosC;
          }
      }     
        
    }
?>