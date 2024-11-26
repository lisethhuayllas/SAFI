<?php
    include('controladores/sesion_existente.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Secretaría académica de la facultad de ingeniería - UNAJMA</title>
    <link rel="stylesheet" href="vistas/estilos/index.css">

    <script src="scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="contenedor-general">
        <div class="contenedor-login">
            <div class="imagen-area">
                <img src="assets/logo-unajma.png" alt="">
                <h3>SECRETARÍA ACADÉMICA DE LA FACULTAD DE INGENIERÍA</h3>
            </div>

            <div class="formulario-area">

                <form action="#" method="post" class="formulario-login">
                    <h1 class="saludo-login">Bienvenido de nuevo</h1>
                    <span class="titulo-login">Inicia sesión con tus datos</span>    

                    <div class="contenedor-input">
                        <label for="input-usuario" class="campo-input label-usuario">DNI</label>
                        <input type="text" placeholder="Ingrese su número de DNI" id="input-usuario" maxlength=8><i class="fa-solid fa-user"></i></input>
                    </div>
                    
                    <div class="contenedor-input">
                        <label for="input-contrasenia" class="campo-input label-contrasenia">CONTRASEÑA</label>
                        <input type="password" placeholder="Ingrese su contraseña" id="input-contrasenia" maxlength=32><i class="fa-solid fa-lock"></i></input>  
                    </div>

                    <div class="contraseña-a">
                        <a href="#" id="olvide-contrasenia-a">Olvidé mi contraseña</a>
                    </div>
                    
                    <button>INGRESAR</button>
                </form>
            </div>
        </div>
    </div>

    <script src="scripts/index.js"></script>
</body>
</html>