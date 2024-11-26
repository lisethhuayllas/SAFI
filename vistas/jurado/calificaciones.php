<?php require_once('../controladores/jurado/jurado_controlador.php'); 
    $datos=juradoControlador::MostrarTesisFinal();?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/jurado/jurado.css">
</head>
<body>
    <div class="cabecera_tesis">
        <div class="titulo_modulo">
            <h1>CALIFICACIÓN DEL PROYECTO</h1>
        </div>
        
        <div class="cantidad_coincidencias">
            <span><b><span id="coincidencias"></span></b> de un total de <b><span id="total"></span></b></span>
        </div>
        
        <div class="seccion_buscador">
            <input type="text" class="input_busqueda" placeholder="Buscar con Titulo de Tesis" maxlength="100">
                <i class="fa-solid fa-magnifying-glass"></i>
            </input>
        </div>
        
    </div>


    <div class="seccion_tabla">
        <table>
            <thead>
                <th>TITULO DE TESIS</th>
                <th>TESISTA</th>
                <th>TIPO</th> 
                <th>ESTADO</th>   
                <th>CALIFICACIÓN</th>
                <th>SUSTENTACIÓN_</th>           
            </thead>

            <tbody id="contenido_tabla">
               
            <tbody>
                <?php 
                for($i=0; $i<mysqli_num_rows($datos) ;$i++) {
                    $datosTesis=mysqli_fetch_array($datos);
                    $data=juradoControlador::ContarFecha($datosTesis['Id_proyecto']);
                    $n=$data['revision'];
                    $estado=$data['estado'];

                    $habilitar=juradoControlador::ContarRevision2($datosTesis['Id_proyecto']);
                    $habilitado=$habilitar['revision'];
                    if($n == 1){
                        if($datosTesis['tipo']=='Sustentacion'){
                            $data=juradoControlador::VerificarTesis($datosTesis['Id_proyecto']);
                            $IdSust=$data['ID_sustentacion'];
                            $habilitar2=juradoControlador::ContarRevisionSusten2($IdSust);
                            $habilitado2=$habilitar2['revision'];
                        }else{
                            $habilitado2=0;
                        }
                    }else{
                        $habilitado2=0;
                    }

                    

                    $jurado=$datosTesis['jurado'];
                    $id=$datosTesis['Id_proyecto'];
                    $titulo=$datosTesis['titulo'];
                    $fecha=$datosTesis['fecha_presentacion'];
                    $TipoTesis=$datosTesis['tipo'];
                    $archivo=$datosTesis['archivo'];
                    $tesista=$datosTesis['tesista'];
                    $estadoT=$datosTesis['estado'];?>
                
                    <tr>
                        <td><?php echo $titulo?></td>
                        <td><?php echo $tesista?></td>
                        <td><?php echo $TipoTesis?></td>
                        <?php
                        if($TipoTesis!='Presentacion'){
                            echo("<td>$estado</td>");
                        }else{
                            echo("<td>$estadoT</td>");
                        }
                        
                        if($habilitado==3 && $estadoT=='inicio'){
                            echo("<td><a href='jurado.php?modulo=CP&ID=$id'>Calificar</a></td>");
                        }else if($habilitado2==3 && $estado=='Pendiente'){
                            echo("<td><a href='jurado.php?modulo=CS&ID=$id&SU=$IdSust'>Calificar</a></td>");
                        }else{
                            echo("<td style='color:red'>No Disponible 1 </td>");
                        }
                        if($TipoTesis!='Presentacion'){
                            if($n==0){
                                echo("<td><a href='jurado.php?modulo=formSustentar&ID=$id'>Crear Fecha</a></td>");
                            }else{
                                //echo("<td>$estado</td>");
                                echo("<td style='color:red'>No Disponible 2 </td>");
                            }
                        }else{
                                echo("<td style='color:red'>No Disponible 3</td>");
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