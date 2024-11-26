<?php require_once('../controladores/jurado/jurado_controlador.php'); 
    $datos=juradoControlador::mostrarTesisSustentacion();?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/jurado/jurado.css">
</head>
<body>
    <div class="cabecera_tesis">
        <div class="titulo_modulo">
            <h1>INFORME DE TESIS</h1>
        </div>
        
    </div>


    <div class="seccion_tabla">
        <table>
            <thead>
                <th>TITULO DE TESIS</th>
                <th>TESISTA</th>
                <th>ARCHIVO</th>
                <th>SUSTENTACIÓN</th>
                <th>CALIFICACIÓN</th>           
            </thead>

            <tbody id="contenido_tabla">
               
            <tbody>
                <?php 
                for($i=0; $i<mysqli_num_rows($datos) ;$i++) {
                    $datosTesis=mysqli_fetch_array($datos);
                    $data=juradoControlador::ContarFecha($datosTesis['Id_proyecto']);
                    $n=$data['revision']; /* Contar cuantas veces ha sido revisado */
                    
                    $estado=$data['estado']; /*Estado de revisión */

                    if($n==1){
                        $data=juradoControlador::VerificarTesis($datosTesis['Id_proyecto']);
                        $IdSust=$data['ID_sustentacion'];
                        $sustentacion=$data['ID_sustentacion'];
                        $sus=juradoControlador::ContarRevisionSusten($IdSust);
                        $IdSus=$sus['revision'];
                        $calificacion=$sus['calificacion'];
                    }else{
                        $IdSus=0;
                        $calificacion='';
                        $sustentacion ='';
                    }
                    
                    
                    $Idjurado=$datosTesis['jurado'];
                    $id=$datosTesis['Id_proyecto'];
                    $titulo=$datosTesis['titulo'];
                    $fecha=$datosTesis['fecha_presentacion'];
                    $TipoTesis=$datosTesis['tipo'];
                    $archivo=$datosTesis['archivo'];
                    $tesista=$datosTesis['tesista'];
                    $tipoJurado=$datosTesis['tipo_jurado'];?>
                
                <tr>
                        <td><?php echo $titulo?></td>
                        <td><?php echo $tesista?></td>                   
                        <td><a href='jurado.php?modulo=ver_tesis&ID=<?=$id?>'> <i class='fa-solid fa-file-pdf'></i></td>
                        <?php if($tipoJurado=='PRESIDENTE' && $n!=1){
                            echo("<td><a href='jurado.php?modulo=fecha&ID=$id'> <i class='fa-solid fa-pen-to-square'></i></a></td>");
                        }else{
                            echo("<td><a href='jurado.php?modulo=verfecha&ID=$sustentacion'><i class='fa-solid fa-eye'></i></a></td>");
                        }?>
                        <?php if($n==1 && $IdSus==0){
                            echo("<td><a href='jurado.php?modulo=revisarS&ID=$id'><i class='fa-solid fa-square-check'></i></a></td>");
                        }else if($IdSus==1){
                            echo("<td>$calificacion</td>");
                        }
                        else{
                            echo("<td style='color:red'>No Disponible</td>");
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