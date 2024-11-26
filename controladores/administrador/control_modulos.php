<?php
    class controlModulos{
        static public function mostrarModulo(){
            if(isset($_GET['modulo'])){
                if($_GET['modulo']=='resoluciones'){
                    include('administrador/resoluciones.php');

                }else if($_GET['modulo']=='trabajos-investigacion'){
                    include('administrador/trabajos_investigacion.php');

                }else if($_GET['modulo']=='tesistas'){
                    include('administrador/tesistas.php');

                }else if($_GET['modulo']=='asesores'){
                    include('administrador/asesores.php');

                }else if($_GET['modulo']=='jurados'){
                    include('administrador/jurados.php');
                
                }else{
                    include('administrador/trabajos_investigacion.php');
                }
            }else{
                include('administrador/trabajos_investigacion.php');
            }
        }
    }
?>