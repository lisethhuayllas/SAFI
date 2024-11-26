<?php

if(isset($_GET["modulo"])){
    switch ($_GET["modulo"]){
        case 'miasesor':
            include("../vistas/tesista/mi_asesor.php");
            break;
        
        case 'subirArchivo':
            include("../vistas/tesista/subirTesis.php");
            break;
        
        case 'verTesis':
            include("../vistas/tesista/verTesis.php");
            break;
        case 'verJurados':
            include("../vistas/tesista/verJurados.php");
            break;  
            
        case 'verfechas':
            include("../vistas/tesista/verFechas.php");
            break;  
        
        default:
            include("../vistas/tesista/mi_asesor.php");
            break;
    }
    
}else{
    include("../vistas/tesista/mi_asesor.php");
}
?>