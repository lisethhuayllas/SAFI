<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/jurado/jurado.css">
</head>
<body>
    <div class="cabecera_roles">
        <div class="titulo_modulo">
            <h1>ROLES</h1>
        </div>
        

        
    </div>


    <div class="seccion_tabla">
        <table>
            <thead>
                <th>TITULO DE TESIS</th>
                <th>TESISTA</th>
                <th>ROL COMO JURADO</th>
                           
            </thead>

            <!-- <tbody id="contenido_tabla"> -->
               
            <?php require_once('../controladores/jurado/jurado_controlador.php'); 
            $datos=juradoControlador::mostrarRol();?>
            <tbody>
                <?php 
                $columnasTabla='';
                for($i=0; $i<mysqli_num_rows($datos) ;$i++) {
                    $datosRol=mysqli_fetch_array($datos);
                    
                    $rol=$datosRol['tipo_jurado'];
                    $id=$datosRol['Id_Proyecto'];
                    $titulo=$datosRol['Titulo'];
                    $nombreCompleto=$datosRol['Tesista'];
                    $TipoTesis=$datosRol['Tipo'];
                
                    //$columnasTabla = $columnasTabla .
                    echo"<tr>
                        <td>$titulo</td>
                        <td>$nombreCompleto</td>
                        <td>$rol</td>
                    </tr>";
                }?>
                
            </tbody>
        </table>
    </div>    
    <script src="../scripts/jurado/roles.js"></script>
</body>
</html>