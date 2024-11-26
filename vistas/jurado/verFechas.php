<?php 
 require_once('../controladores/jurado/jurado_controlador.php'); 
 if (isset($_GET['ID'])) {
    if($_GET['ID']!=NULL){
        $Idsustentacion = ($_GET['ID']);
    }else{
        $Idsustentacion = 0;
    }
   
    
  }
 $datos=juradoControlador::VerFecha($Idsustentacion);
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/jurado/sustentacion.css">
    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head> 
<body> 
<div class='titulo-modulo'>
    <p><b>DETALLES DE SUSTENTACIÓN </b></p> </div>

<div class="cuadro">
     <table class="tablaFechas" >
            
        <tr>
           <td class="fila" >
               <div class="cuadroF"> 
                   <?php 
                   if($datos){
                    $idSus= $datos['ID_sustentacion'];
                      $idTesis= $datos['proyecto'];
                      $lugar= $datos['lugar'];
                      $fecha= $datos['fecha_sustentacion'];
                      $hora= $datos['hora'];
                      $calificacion= $datos['calificacion'];
                   ?>
                   
                   <div class="cuadroF0"> <p><i>  <?php echo  "";?></i></p> </div>
                     <p class="Des" >Lugar:<p>
                     <div class="cuadroF1">  <p> <i class="fa-solid fa-location-dot"></i> <?php echo  $lugar;?>  </p>  </div>
                     <p class="Des" >Fecha:<p>
                     <div class="cuadroF1"> <p> <i class="fa-regular fa-calendar"></i>  <?php echo  $fecha;?>  </p> </div>
                     <p class="Des" >Hora: <p>
                     <div class="cuadroF1"> <p> <i class="fa-solid fa-clock"></i> <?php echo  $hora;?></p> </div>
                     <p class="Des" > Nota:<p>
                     <div class="cuadroF1"> <p> <?php echo  $calificacion;?>  </p> </div>
                    <?php
                    }else {echo "<p class='NotDatos'>NO HAY DATOS DISPONIBLES</p>";}?>

                </div> 
            </td>    

        </tr>

    </table>
 
</div>

<?php  ?>

</body>
