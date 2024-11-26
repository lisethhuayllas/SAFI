<?php
    //VERIFICACION DE PARAMETROS PARA LA RECUPERACION DE CONTRASEÑA

    if(isset($_POST['correo-recuperacion']) && isset($_POST['token'])){
        $correo=$_POST['correo-recuperacion'];
        $token=$_POST['token'];

        $asunto = "Cambio de contraseña";

        $headers = "From: soporte@SAFI_UNAJMA.com" . "\r\n";
        $headers .= "CC:" . $correo . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        $mensaje = "
            <html>
                <head>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
                        body{
                            font-family: 'Poppins', sans-serif;
                        }
                        .contenedor-mensaje{display:grid; 
                            width:1000px; 
                            height:200px; 
                            background-color: rgb(59, 59, 59);
                            margin: 0 auto; 
                            border-radius:10px; 
                            padding: 10px 10px; 
                            text-align: center; 
                            color:#fff;}
                        .mensaje>h1{
                            color:#fff;
                        }
                        .mensaje>span{
                            margin-top:-80px; 
                            font-size:14px; 
                            color: #DFDFDF;
                        }
                        .clave{
                            margin-top:10px;
                            width:250px;
                            height:50px;
                            border-radius:5px;
                            background-color:#fffb00;
                            font-size:16px;
                            font-weight: bold;
                            margin:0 auto;
                            border: none;
                        }
                        .clave>span{
                            color:#000;
                            font-size: 27px;
                            margin: 0 auto; 
                            line-height: 50px;
                        }
                    </style>
                </head>
                <body>
                    <div class='contenedor-mensaje'>
                        <div class='mensaje'>
                            <h1>CAMBIAR MI CONTRASEÑA</h1>
                            <span>Hola, para poder cambiar tu contraseña, ingresa el siguiente código en el formulario:</span>
                        </div>
                        
                        <div class='clave'>
                            <span>".$token."</span>
                        </div>
                    </div>
                </body>
            </html>
            ";
    
        mail($correo, $asunto, $mensaje, $headers);

        echo $correo . " ". $token;
    }
?>