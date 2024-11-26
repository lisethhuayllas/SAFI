<?php
   require_once('../controladores/tesista/subirArchivoC.php'); 
   $autor=$_SESSION['DNI-usuario'];
   $archivoC = new ArchivosC();
   $guardarArc=$archivoC->guardarArchivosC();
   $editarArc=$archivoC->editarArchivosC();
   $tesis= $archivoC->verArchivosC();
   //var_dump($a); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/tesista/subirArchivo.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    

    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head> 
<body> 
     
<?php  
if($tesis){
    $tituloTesis= $tesis['titulo'];
    $idTesis= $tesis['Idtesis'];
    $archivo= $tesis['tesis'];
    $tipo= $tesis['tipo'];

    $tabla= " <div class='titulo-modulo'>
    <p><b>EDITAR TRABAJO DE INVESTIGACION</b></p>
    
     </div>
    <div class='contenedor-principal'>
            <div class='crud-tesis'>
                <table class='tabla-tesis' >
                    <thead>
                        <th>ARCHIVO</th>
                        <th>TITULO</th>
                        <th>TIPO</th>
                        
                    </thead>
    
                    <tr>
                         <td> <a href='tesista/verTesis.php' TARGET='_blanc'>
                          <i class= 'fa-regular fa-file-pdf'></i> 
                          </td>
                         <td> $tituloTesis </td>
                         <td>  $tipo </td>
                    </tr>    
                </table>
            </div>
        </div> ";
 
 echo "$tabla";
 
 if($editarArc)
    {
        $res= " <div class='guardarArc'>
      <p>El archivo se guardo exitosamente</p>
       </div> ";
       echo $res;
    }

    $editar= " 

<div class='contenido-principal'>
   <form class='insertarTesis' id='formTes' method='post' action='' enctype='multipart/form-data'>

       <input class='nom' type='hidden' name='AutorE' value='$autor'  required >
       <input class='nom' type='hidden' name='IdtesisE' value='$idTesis'  required >


       <label for='DescripcionEjercicio1'>TITULO </label>
       <input class='Des' type='text' value='$tituloTesis' name='TituloE' required >

       <label for='NivelEjercicio1'>TIPO</label>
       <select class='opt' name='TipoE'>
           <option>Presentacion</option>
           <option>Sustentacion</option> 
       </select>

       <input  id='TesisNew' class='arch' type='file' name='TesisE' size='10' required>
       <button class='boton1' type='submit' value='Editar' name='editarE'>ACTUALIZAR</button>
  </form> 
</div> ";

    echo "$editar";
    
 

}else {
    if($guardarArc)
    {
        $res= " <div class='guardarArc'>
      <p>El archivo se guardo exitosamente</p>
       </div> ";
       echo $res;
    }

    $agregar= " <div class='titulo-modulo'>
      <p><b>PUBLICAR TRABAJO DE INVESTIGACION</b></p>
       </div>

      <div class='contenido-principal'>
         <form class='insertarTesis' id='formTesi' method='post' action='' enctype='multipart/form-data'>

             <input class='nom' type='hidden' name='AutorT' value='$autor'  required >

             <label for='DescripcionEjercicio1'>TITULO </label>
             <input class='Des' type='text' placeholder='Ingrese titulo del trabajo de investigacion' name='TituloT' required >

             <label for='NivelEjercicio1'>TIPO</label>
             <select class='opt' name='TipoT'>
                 <option>Presentacion</option>
                 <option>Sustentacion</option> 
             </select>

             <input id='TesisNew1' class='arch' type='file' name='Tesis' size='10' required >
             <button class='boton1' type='submit' value='Agregar' name='EnviarT'>AGREGAR</button>
        </form>
      </div> ";

    echo "$agregar";
    
   } 

?>

<script src="../scripts/tesista/valTesis.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>


</body> 
