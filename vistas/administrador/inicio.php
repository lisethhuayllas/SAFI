<!DOCTYPE html>
<html lang="es">
<head>
    
</head>
<body>
    <style>
        .saludo{
          
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .saludo > p{
            font-size: 20px;
            margin-right: 20px;
            font-weight: 600;
            color: #1A75D6;
        }

        .saludo > span{
            font-size: 18px;
        }
    </style>

    <div class="saludo">
        <p>BIENVENIDO:</p> <span><?php print_r(datosUsuarioControlador::muestraNombreUsuario());?></span>
    </div>

    <p style="font-size: 18px;">Esperamos que tengas la mejor experiencia el día de hoy!</p>

</body>
</html>