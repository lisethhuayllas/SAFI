<?php
    include('../modelos/index_modelo.php');

    class indexControlador{
        //CONTROL DE SESIONES
        static public function crear_sesion($DNI,$contrasenia,$rol){
            session_start();
            $_SESSION['DNI-usuario']=$DNI;
            $_SESSION['contrasenia-usuario']=$contrasenia;
            $_SESSION['rol-usuario']=$rol;
        }
        //FIN

        //COMPROBAR SI SE ENVIARON DATOS POR EL FORMULARIO
        static public function datos_recibidos($DNI,$contrasenia,$rol){
            switch($rol){
                case 'administrador':
                    indexControlador::crear_sesion($DNI,$contrasenia,'administrador');
                    echo "vistas/administrador.php";
                    break;
                
                case 'tesista':
                    indexControlador::crear_sesion($DNI,$contrasenia,'estudiante');
                    echo "vistas/tesista.php";
                    break;
                
                case 'asesor':
                    indexControlador::crear_sesion($DNI,$contrasenia,'asesor');
                    echo "vistas/asesor.php";
                    break;
                
                case 'jurado':
                    indexControlador::crear_sesion($DNI,$contrasenia,'jurado');
                    echo "vistas/jurado.php";
                    break;

                case 'perfil':
                    indexControlador::crear_sesion($DNI,$contrasenia,'perfil');
                    echo "vistas/Perfil.php";
                    break;
                
                default:
                    echo "index.php";
                    break;
            }
        }
        //FIN
    }
    
    //VALIDACION DE USUARIO EXISTENTE
    if(isset($_POST['input-DNI']) && isset($_POST['input-contrasenia'])){

        $DNI=$_POST['input-DNI'];
        $contrasenia= $_POST['input-contrasenia'];

        $respuesta=indexModelo::validar_usuario($DNI);
        $res=indexModelo::contar_perfil($DNI);
        $perfil=$res['perfil'];

        if($perfil==1){
            if($respuesta){
                $rol=$respuesta['rol'];
                $contraseniaHasheada=$respuesta['contrasenia'];

                $validacion= password_verify($contrasenia,$contraseniaHasheada);

                if($validacion){

                    indexControlador::datos_recibidos($DNI,$contraseniaHasheada,$rol);
                }else{
                    echo "Usuario y/o contraseña incorrectas";
                }

            }else{
                echo "Usuario y/o contraseña incorrectas";
            }
        }else{
            if($respuesta){
                $contraseniaHasheada=$respuesta['contrasenia'];
                $per='perfil';
                $validacion= password_verify($contrasenia,$contraseniaHasheada);
                if($validacion){
                    indexControlador::datos_recibidos($DNI,$contraseniaHasheada,$per);
                }else{
                    echo "Usuario y/o contraseña incorrectas";
                }
            }

        }
    }
    if(isset($_POST['username'])){
        $DNI=$_POST['username'];
        $contrasenia= $_POST['password'];
        $rol=$_POST['rol'];
        include('../controladores/cerrar_sesion.php');
        indexControlador::datos_recibidos($DNI,$contrasenia,$rol);
    }

    //VALIDACION DE USUARIO EXISTENTE Y OBTENCION DE CORREO
    if(isset($_POST['DNI-recuperacion']) && isset($_POST['recuperacion'])){

        $DNI=$_POST['DNI-recuperacion'];

        $respuesta=indexModelo::validar_usuario_recuperacion($DNI);

        if($respuesta){
            $correo=$respuesta['correo'];
            $rol=$respuesta['rol'];

            $datos=[$correo,$rol];

            echo(json_encode($datos));

        }else{
            echo "Usuario no registrado";
        }
    }

    //CAMBIO DE CONTRASEÑA
    if(isset($_POST['usuario-recuperacion']) && isset($_POST['rol-recuperacion']) && isset($_POST['contrasenia-recuperacion'])){

        $DNI=$_POST['usuario-recuperacion'];
        $rol=$_POST['rol-recuperacion'];
        $contrasenia=password_hash($_POST['contrasenia-recuperacion'],PASSWORD_DEFAULT);

        indexModelo::cambiar_contrasenia($DNI,$rol,$contrasenia);
    }
?>