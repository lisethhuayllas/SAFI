<?php
   // session_start(); 
   require_once('../../modelos/tesista/verArchivoM.php');

    class verArchivosC{
        function __construct(){
            $this->ArchivosM = new verArchivosM();
        }
        
        public function verArchivosC(){
            $autor=$_SESSION['DNI-usuario'];
            $resultado = $this->ArchivosM->verArchivosM($autor);
            return $resultado;

        }

    }
?>