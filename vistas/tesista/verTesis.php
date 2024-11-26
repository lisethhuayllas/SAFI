<?php 
include('../../controladores/control_rutas.php');
controlRutas::validaRol("estudiante");

 require_once('../../controladores/tesista/verArchivoC.php'); 
 $autor=$_SESSION['DNI-usuario'];
 $archivoC = new verArchivosC();
 $tesis= $archivoC->verArchivosC();
 //var_dump($a); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/tesista/verArchivo.css">
    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head> 
<body> 

<?php 
  if($tesis){
     $tituloTesis= $tesis['titulo'];
     $idTesis= $tesis['Idtesis'];
     $archivo= $tesis['tesis'];
     $tabla= " <div class='titulo-modulo'>
     <p><b>VIZUALIZANDO TRABAJO DE INVESTIGACION</b></p> </div>";
    
    // echo "$tabla";

     $verArchivo="
      <iframe class='verTesis' src='data:application/pdf;base64 ,".base64_encode(stripslashes($archivo)) ."' frameborder='0'></iframe>
    ";

    echo "$verArchivo";
  }
?>

</body>
