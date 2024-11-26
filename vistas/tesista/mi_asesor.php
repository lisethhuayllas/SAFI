<?php
  require_once('../controladores/tesista/verAsesorJuradoC.php'); 
  $archivoC = new verAsesorJuradoC();
   $archivoC->miAsesorC();
   $a= $archivoC->miAsesorC();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/tesista/subirArchivo.css">
    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head> 
<body> 
 
    <div class='titulo-modulo'>
    <p><b>VIZUALIZAR DETALLE DE MI ASESOR</b></p>
    
     </div>
    <div class='contenedor-principal'>
            <div class='crud-tesis'>
                <table class='tabla-tesis' >
                    <thead>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>CORREO</th>
                        <th>DOCENTE.</th>
                        <th>ESTADO</th>
                        <th>TELEFONO</th>
                    </thead>
                    <?php if($a){ ?>
                    <tr>
                         <td> <?=$a[2]?>  </td>
                         <td><?=$a[3]?></td>
                         <td> <?=$a[4]?></td>
                         <td> <?=$a[6]?></td>
                         <td> <?=$a[8]?></td>
                         <td> <?=$a[5]?></td>
                        
                    </tr>  
                    <?php } ?>
                </table>
            </div>
        </div> 
        

</body> 
