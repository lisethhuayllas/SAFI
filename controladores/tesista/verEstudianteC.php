<?php
   // session_start(); 
   require_once('../modelos/tesista/verEstudianteM.php');

    class verEstudianteC{
        function __construct(){
            $this->ArchivosM = new verArchivosM();
        }

        public function verEstudianteC(){
            $autor=$_SESSION['DNI-usuario'];
            $resultado = $this->ArchivosM->verEstudianteM($autor);
            return $resultado;
        }

    }
?>