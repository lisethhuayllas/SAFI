<?php
   // session_start(); 
   require_once('../modelos/tesista/verAsesorJuradoM.php');
 
   
    class verAsesorJuradoC{
        function __construct(){
            $this->asesorJuradoM = new verAsesorJuradoM();
        }

         public function miAsesorC(){
            $autor=$_SESSION['DNI-usuario'];
            $resultado = $this->asesorJuradoM->miAsesorM($autor);
            return $resultado;
           
         }

         public function juradoC($idTesis){
            $resultado = $this->asesorJuradoM->juradoM($idTesis);
            return $resultado;
         }
        
        
    }
?>