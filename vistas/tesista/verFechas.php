<?php 
 require_once('../controladores/tesista/subirArchivoC.php'); 
 require_once('../controladores/tesista/verFechasC.php'); 
 $archivoC = new ArchivosC();
 $fechaC = new verFechasC();
 $tesis= $archivoC->verArchivosC();
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/tesista/subirArchivo.css">
    <link rel="stylesheet" href="estilos/tesista/avances.css">
    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head> 
<body> 
<div class='titulo-modulo'>
    <p><b>VIZUALIZAR DETALLES </b></p> </div>

<div class="cuadro">
     <table class="tablaFechas" >

        <tr >
                <th>  <div class="F_titulo1"> <p>Sustentacion de Tesis</p> </div>   </th>
                <th>  <div class="F_titulo1"> <p>Revisiones de Tesis</p> </div>   </th>
               
        </tr>
           
            
        <tr>
           <td class="fila" >
               <div class="cuadroF"> 
                   <?php 
                   if($tesis){
                      $idTesis= $tesis['Idtesis'];
                      $datos= $fechaC->revisionC($idTesis);
                      $datos2= $fechaC->sustentarC($idTesis);
                   if($datos2 ){?>
                   
                    <div class="cuadroF0"> <p><i>Tiempo restante: <?php echo  $datos2["TiempoRestante"];?></i></p> </div>
                     <p class="Des" >Lugar:<p>
                     <div class="cuadroF1">  <p> <i class="fa-solid fa-location-dot"></i> <?php echo  $datos2["Datos"][1];?>  </p>  </div>
                     <p class="Des" >Fecha:<p>
                     <div class="cuadroF1"> <p> <i class="fa-regular fa-calendar"></i>  <?php echo  $datos2["Datos"][2];?>  </p> </div>
                     <p class="Des" >Hora: <p>
                     <div class="cuadroF1"> <p> <i class="fa-solid fa-clock"></i> <?php echo  $datos2["Datos"][3];?></p> </div>
                     <p class="Des" >Estado:<p>
                     <div class="cuadroF1"> <p>  <?php echo  $datos2["Datos"][4];?> </p> </div>
                     <p class="Des" > Nota:<p>
                     <div class="cuadroF1"> <p> <?php echo  $datos2["Datos"][5];?>  </p> </div>
                    <?php }else {echo "<p class='NotDatos'>NO HAY DATOS</p>";}} 
                    else {echo "<p class='NotDatos'>NO HAY DATOS DISPONIBLES</p>";}?>

                </div> 
            </td>    
             
            <td>
                <div class="cuadroF">

                     <?php 
                     if($tesis){
                      $idTesis= $tesis['Idtesis'];
                      $datos= $fechaC->revisionC($idTesis);
                      $datos2= $fechaC->sustentarC($idTesis);
                     if($datos2 ){?>
                     
                     <p class="Des" >Observaciones:<p>
                     <div class="cuadroF1"> <p> <i class="fa-solid fa-comment"></i> <?php echo $datos[5]; ?></p> </div>
                     <p class="Des" >Fecha de revision:<p>
                     <div class="cuadroF1"> <p> <i class="fa-regular fa-calendar"></i>  <?php echo $datos[1]; ?> </p> </div>
                     <p class="Des" >Estado:<p>
                     <div class="cuadroF1"> <p> <?php echo $datos[3]; ?> </p> </div>
                     <?php }else {echo "<p class='NotDatos'>NO HAY DATOS</p>";} }
                      else {echo "<p class='NotDatos'>NO HAY DATOS DISPONIBLES</p>";} ?>

                </div>
            </td>

        </tr>

    </table>
 
</div>

<?php  ?>

</body>
