<?php
   // session_start(); 
   require_once('../modelos/tesista/subirArchivoM.php');

    class ArchivosC{
        function __construct(){
            $this->ArchivosM = new ArchivosM();
        }

         public function guardarArchivosC(){

                   if(isset($_FILES['Tesis']['name'])){
                         switch ($_FILES['Tesis']['type']) {
                              case 'image/png':   $ext = 'png'; break;
                              case 'application/pdf':  $ext = 'pdf'; break;
                              default:            $ext = ''; break;
                         }
                       if ($ext){
                              $archivo=$_FILES['Tesis'];
                              $temName= $archivo['tmp_name'];
                              $contenido=file_get_contents($temName);
                              $pdf=addslashes( $contenido);
                        
                              $datosC =array();
                              $datosC['tituloT'] = $this->ArchivosM->limpieza($_POST['TituloT']);
                              $datosC['autorT'] = $this->ArchivosM->limpieza($_POST['AutorT']);
                              $datosC['tipoT'] = $this->ArchivosM->limpieza($_POST['TipoT']);
                              $datosC['imagenBinario'] =$pdf;
                              $resultado = $this->ArchivosM->guardarArchivosM($datosC);
                              return $resultado;
                         }

                    } else{ return false ;}
          
        }
        
        public function editarArchivosC(){

                        if(isset($_FILES['TesisE']['name'])){
                              switch ($_FILES['TesisE']['type']) {
                                   case 'image/png':   $ext = 'png'; break;
                                   case 'application/pdf':  $ext = 'pdf'; break;
                                   default:            $ext = ''; break;
                              }
                            if ($ext){
                                   $archivo=$_FILES['TesisE'];
                                   $temName= $archivo['tmp_name'];
                                   $contenido=file_get_contents($temName);
                                   $pdf=addslashes( $contenido);
                                   
                                   $datosC =array();
                                   $datosC['tituloE'] = $this->ArchivosM->limpieza($_POST['TituloE']);
                                   $datosC['IdtesisE'] = $this->ArchivosM->limpieza($_POST['IdtesisE']);
                                   $datosC['autorE'] = $this->ArchivosM->limpieza($_POST['AutorE']);
                                   $datosC['tipoE'] = $this->ArchivosM->limpieza($_POST['TipoE']);
                                   $datosC['tesisBinario'] =$pdf;
                                   $resultado = $this->ArchivosM->editarArchivosM($datosC);
                                   return $resultado;
                              }
                         } else{ return false ;}
           
        }
        
        public function verArchivosC(){
            $autor=$_SESSION['DNI-usuario'];
            $resultado = $this->ArchivosM->verArchivosM($autor);
            return $resultado;

        } 

    }
?>