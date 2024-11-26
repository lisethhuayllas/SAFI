<?php require_once('../controladores/jurado/jurado_controlador.php'); 
    $datos=juradoControlador::mostrarTesis();
    
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/jurado/jurado.css">
    
</head>
<body>
    
    <div class="cabecera_tesis">
        <div class="titulo_modulo">
            <h1>PERFIL DE PROYECTO </h1>
        </div>
        
        
    </div>


    <div class="seccion_tabla">
        <table>
            <thead>
                <th>TITULO DE TESIS</th>
                <th>TESISTA</th>
                <th>FECHA</th>
                <th>ARCHIVO</th>
                <th>REVISIÓN</th>           
            </thead>

            <tbody id="contenido_tabla">
               
            <tbody>
                <?php 
                for($i=0; $i<mysqli_num_rows($datos) ;$i++) {
                    $datosTesis=mysqli_fetch_array($datos);
                    $data=juradoControlador::ContarRevision($datosTesis['Id_proyecto']);
                    $n=$data['revision'];
                    $estado=$data['estado_revision'];                   
                    
                    $Idjurado=$datosTesis['jurado'];
                    $id=$datosTesis['Id_proyecto'];
                    $titulo=$datosTesis['titulo'];
                    $fecha=$datosTesis['fecha_presentacion'];
                    $TipoTesis=$datosTesis['tipo'];
                    $archivo=$datosTesis['archivo'];
                    $tesista=$datosTesis['tesista'];
                    ?>
        
                    <tr>
                        <td><?php echo $titulo?></td>
                        <td><?php echo $tesista?></td>
                        <td><?php echo $fecha?></td>                        
                        <td><a href='jurado.php?modulo=ver_tesis&ID=<?=$id?>'> <i class='fa-solid fa-file-pdf'></i></td>
                        <?php if($n==0){
                            echo("<td><a href='jurado.php?modulo=revisar&ID=$id'><i class='fa-solid fa-square-check'></i></a></td>");
                        }
                        else{
                            echo("<td>$estado</td>");
                        }?>
  
                    </tr>
                    
            <?php
                }?>
                
            </tbody>
        </table>
    </div>    
    <!-- <script src="../scripts/jurado/rolJurado.js"></script> -->
</body>
</html>