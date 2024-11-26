<?php
    
    require_once('../modelos/jurado/jurado_modelo.php');
    

   class juradoControlador{

        static public function mostrarRol(){
            $datos=juradoModelo::rolJurado($_SESSION['DNI-usuario']);
            return $datos;
        }
        
        static public function mostrarTesis(){
            $datos=juradoModelo::verTesis($_SESSION['DNI-usuario']);
            return $datos;
        }

        static public function RevisarTesis(){
            if (isset($_POST['submit'])) {
                $idArchivo = ($_POST['id_trabajo']);
                $DNI = ($_POST['dni']);
                $fecha = ($_POST['fecha']);
                $estado = ($_POST['estado']);
                $observacion = ($_POST['observaciones']);
                $tipo = ($_POST['tipo']);
            }
            $datos=juradoModelo::RevisarTesiss($idArchivo,$DNI,$fecha,$estado,$observacion,$tipo);
            return $datos;
        }

        static public function mostrararchivo(){
            if (isset($_GET['ID'])) {
                $idArchivo = ($_GET['ID']);
            }
            $datos=juradoModelo::verArchivo($_SESSION['DNI-usuario'],$idArchivo);
            return $datos;
        }

        static public function ContarRevision($id){
            $data=juradoModelo::contarRevision($_SESSION['DNI-usuario'],$id);
            return $data;
        }
/*======================*/
        static public function mostrarTesisSustentacion(){
            $datos=juradoModelo::TesisSustentacion($_SESSION['DNI-usuario']);
            return $datos;
        }

        static public function VerificarTesis($id){
            $data=juradoModelo::Verificartesiss($id);
            return $data;
        }

        static public function ContarRevisionSusten($id){
            $data=juradoModelo::contarRevisionSust($_SESSION['DNI-usuario'],$id);
            return $data;
        }


        /*Calificando informe */
        static public function RevisarTesisSustentacion(){ 
            if (isset($_POST['submit'])) {
                $idArchivo = ($_POST['id_trabajo']);
                $DNI = ($_POST['dni']);
                $sustentacion = ($_POST['sust']);
                $calificacion = ($_POST['nota']);
            }
            $datos=juradoModelo::RevisarTesisSust($idArchivo,$DNI,$calificacion,$sustentacion);
            return $datos;
        }

        static public function ContarFecha($id){
            $data=juradoModelo::contarFecha($id);
            return $data;
        }
/** ============ */



        static public function fecha_sustentacion(){
            if (isset($_POST['submit'])) {
                $idArchivo = ($_POST['id_trabajo']);
                $DNI = ($_POST['DNI']);
                $lugar = ($_POST['lugar']);
                $fecha = ($_POST['fecha']);
                $hora = ($_POST['hora']);
            }
            $datos=juradoModelo::Fecha_Sustentacion($idArchivo,$DNI,$lugar,$fecha,$hora);
            return $datos;
        }

        static public function ContarRevision2($id){
            $data=juradoModelo::contarRevision2($id);
            return $data;
        }

        static public function MostrarTesisFinal(){
            $datos=juradoModelo::verTesisFinal($_SESSION['DNI-usuario']);
            return $datos;
        }

        
        

        

        static public function ContarRevisionSusten2($id){
            $data=juradoModelo::contarRevisionSust2($id);
            return $data;
        }

        static public function CalificarTesisP(){
            if (isset($_POST['submit'])) {
                $idArchivo = ($_POST['id_trabajo']);
                $DNI = ($_POST['dni']);
                $estado = ($_POST['estado']);
            }
            $datos=juradoModelo::CalificarTesisP_M($idArchivo,$DNI,$estado);
            return $datos;
        }

        static public function CalificarTesisS(){
            if (isset($_POST['submit'])) {
                $idArchivo = ($_POST['id_trabajo']);
                $Idsus = ($_POST['idsus']);
                $nota = ($_POST['nota']);
                if($nota>=18){
                    $estado='Excelente';
                }else if($nota>=16){
                    $estado='Muy bueno';
                }else if($nota>=14){
                    $estado='Bueno';
                }
                else if($nota>=13){
                    $estado='Bueno';
                }
                else{
                    $estado='desaprobado';
                }
            }
            $datos=juradoModelo::CalificarTesisS_M($idArchivo,$Idsus,$nota,$estado);
            return $datos;
        }

        static public function VerFecha($id){
            $data=juradoModelo::verFecha($id);
            return $data;
        }
    }
?>