<?php
    class controlModulos{
        static public function mostrarModulo(){
            if(isset($_GET['modulo'])){
                if($_GET['modulo']=='roles'){
                    include("jurado/roles.php");

                }else if($_GET['modulo']=='presentacion'){
                    include('jurado/perfil_proyecto.php');
                
                }else if($_GET['modulo']=='ver_tesis'){
                    include('jurado/mostrar_tesis.php');

                // }else if($_GET['modulo']=='calificar'){
                //     include('jurado/calificaciones.php');

                }else if($_GET['modulo']=='inicio'){
                    include('jurado/perfil_proyecto.php');
                }
                else if($_GET['modulo']=='sustentacion'){
                    include('jurado/sustentacion.php');
                }    
                else if($_GET['modulo']=='revisar'){
                    include('jurado/Form_perfil.php');
                }
                else if($_GET['modulo']=='revisarS'){
                    include('jurado/calificar_sustentacion.php');
                }
                else if($_GET['modulo']=='fecha'){
                    include('jurado/Form_sustentacion.php');
                } 
                else if($_GET['modulo']=='CS'){
                    include('jurado/CForm_sustentacion.php');
                }
                else if($_GET['modulo']=='verfecha'){
                    include('jurado/verFechas.php');
                }           
                else{
                    include('jurado/perfil_proyecto.php');
                }
            }else{
                include('jurado/perfil_proyecto.php');
            }
        }
    }

?>