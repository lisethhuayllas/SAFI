<?php
require_once('../controladores/asesor/trabajosC.php');
$resultado = Trabajos_investigacin_controlador::ver_trabajoC();
$datos = mysqli_fetch_array($resultado);

  $pdf_data = $datos['archivo'];
  $pdf_base64 = base64_encode(stripslashes($pdf_data));


  $verArchivo = "
                  <iframe class='verTesis' src='data:application/pdf;base64 ," . $pdf_base64 . "' frameborder='0' style='border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; position: absolute;' allowfullscreen></iframe>
                  ";

                 
  echo "$verArchivo";
  ?>
