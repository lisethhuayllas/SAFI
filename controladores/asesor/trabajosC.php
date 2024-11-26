<?php
require_once('../modelos/asesor/trabajosM.php');

class Trabajos_investigacin_controlador
{


    //Mostrar asesorados que subieron archivos o avances de su proyecto
 static public function mostrar_asesoradosC()
 {
   $resultado = Trabajos_investigacin_modelo::mostrar_asesoradosM();
   return $resultado;
 }
  //Mostrar pdf de asesorado
  static public function ver_trabajoC()
  {

    $dniasesorado = ($_GET['DNI']);

    $resultado = Trabajos_investigacin_modelo::ver_trabajoM($dniasesorado);
    return $resultado;
  }
}
