<?php
 require_once('../controladores/tesista/subirArchivoC.php');
 require_once('../controladores/tesista/verAsesorJuradoC.php'); 
 $archivoC = new ArchivosC();
 $tesis= $archivoC->verArchivosC();
   //var_dump($a); 
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
    <p><b>VIZUALIZAR DETALLE DE JURADOS</b></p> 
<?php  

    ?>
    
     </div>
    <div class='contenedor-principal'>
            <div class='crud-tesis'>
                <table class='tabla-tesis' >
                    <thead>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>CARGO</th>
                        <th>ESTADO</th>
                        <th>CORREO</th>
                        <th>TELEFONO</th>
                    </thead>
                    <?php 
                    if($tesis){  
                         $idTesis= $tesis['Idtesis'];
                         $verC = new verAsesorJuradoC();
                         $datosC=  $verC->juradoC($idTesis);
                    if( $datosC){
                    for($i=0; $i<4; $i++){ ?>
                    <tr>
                         <td> <?php  echo  $datosC[$i]['nombre'];  ?>   </td>
                         <td> <?php  echo  $datosC[$i]['apellido']; ?>  </td>
                         <td> <?php  echo  $datosC[$i]['cargo']; ?>  </td>
                         <td> <?php  echo  $datosC[$i]['estado'];   ?>  </td>
                         <td> <?php  echo  $datosC[$i]['correo'];   ?>  </td>
                         <td> <?php  echo  $datosC[$i]['telefono']; ?>  </td>
                       
                    </tr> 

                    <?php   
                       }  
                    } 
                }
                    ?>

                </table>
            </div>
        </div> 

</body> 

