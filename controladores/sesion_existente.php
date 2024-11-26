<?php
    session_start();
    
    class sesionExistente{
        static public function sesion_existente($rol){
            switch($rol){
                case "administrador":
                    header('location:vistas/administrador.php');
                    break;
                
                case "estudiante":
                    header('location:vistas/tesista.php');
                    break;
                
                case "asesor":
                    header('location:vistas/asesor.php');
                    break;
                
                case "jurado":
                    header('location:vistas/jurado.php');
                    break;
                case "perfil":
                    header('location:vistas/Perfil.php');
                    break;
            }
        }
    }

    if(isset($_SESSION['DNI-usuario']) && isset($_SESSION['contrasenia-usuario']) && isset($_SESSION['rol-usuario'])){
        sesionExistente::sesion_existente($_SESSION['rol-usuario']);

        echo $_SESSION['rol-usuario'];
    }
?>