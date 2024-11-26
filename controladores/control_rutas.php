<?php
    session_start();

    class controlRutas{
        static public function validaRol($rol){
            if(!isset($_SESSION['rol-usuario']) || $_SESSION['rol-usuario']!==$rol){
                header('location:../index.php');
            }
        }
    }
?>