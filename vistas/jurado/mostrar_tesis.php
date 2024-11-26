<?php 
require_once('../controladores/jurado/jurado_controlador.php'); 
$datos=juradoControlador::mostrararchivo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/jurado/verTesis.css">
    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head> 
<body> 

<?php
  $jurado = mysqli_fetch_array($datos);  
  $archivo= $jurado['archivo'];
  $verArchivo=" <div id='tesis'>
  <iframe class='verTesis' src='data:application/pdf;base64 ,".base64_encode(stripslashes($archivo)) ."' frameborder='0'></iframe>
  </div>";

  echo "<H1>PROYECTO DE TESIS</H1>";
  echo "$verArchivo";
  ?>
            
</body>

