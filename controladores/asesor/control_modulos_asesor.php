<?php
class controlModulos
{
    static public function mostrarModulo()
    {
        if (isset($_GET['modulo'])) {
            if ($_GET['modulo'] == 'asesorados') {
                include('asesor/asesorados.php');
            }else if ($_GET['modulo'] == 'avances_proyectos') {
                include('asesor/avances_proyectos.php');
            } else if ($_GET['modulo'] == 'detalles_asesorados') {
                include('asesor/detalles_asesorados.php');
            } else if ($_GET['modulo'] == 'proyectos') {
                include('asesor/proyectos.php');
            } else {
                include('asesor/asesorados.php');
            }
        }
    }
}
