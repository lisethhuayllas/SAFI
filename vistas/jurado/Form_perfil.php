<?php require_once('../controladores/jurado/jurado_controlador.php'); 
$datos=juradoControlador::mostrarTesis();
if (isset($_GET['ID'])) {
  $Idtesis = ($_GET['ID']);
}
for($i=0; $i<mysqli_num_rows($datos) ;$i++) {
  $datosTesis=mysqli_fetch_array($datos);

  if($datosTesis['Id_proyecto']==$Idtesis){
    $Idjurado=$datosTesis['jurado'];
    $id=$datosTesis['Id_proyecto'];
    $titulo=$datosTesis['titulo'];
    $tipo=$datosTesis['tipo'];
  }
}
$enviado=false;
if (isset($_POST['submit'])) {
  juradoControlador::RevisarTesis();
  $enviado=true;
  
  $estado=$_POST['estado'];
  $obs=$_POST['observaciones'];
  $fecha=$_POST['fecha'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/jurado/form.css">
    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head> 
<body>
  <?php
  if(!$enviado){

  ?>
  <!-- Se necesitan, DNi jurado, fecha, estado_revision, trabajo_revisado, observaciones, tipo (del proyecto)  -->
  <h2>REVISAR PERFIL DE PROYECTO</h2>
  <div class="container">
    <form id="contact" action="" method="post">
      <input type="hidden" id="id_trabajo" name="id_trabajo" value="<?=$id?>" readonly> 
      <input type="hidden" id="dni" name="dni" value="<?=$Idjurado?>" readonly>
      <input type="hidden" id="tipo" name="tipo" value="<?=$tipo?>" readonly>

      <label for="tesis">TESIS:</label>
      <input type="text" id="tesis" name="tesis" value="<?=$titulo?>" readonly>
      
      <div class="fecha-container">
        <label for="fecha">Fecha   :</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo date("Y-m-d"); ?>">
      </div>
      <br>
      <div class="estado-container">
      <label for="estado">Estado   :</label>
        <select id="estado" name="estado">
          <option value="aprobado">Aprobado</option>
          <option value="desaprobado">Desaprobado</option>
        </select>
      </div>

      <label for="observaciones">Observaciones:</label>
      <textarea id="observaciones" name="observaciones">Ninguna</textarea>

      <input type="submit" name="submit" value="Enviar">
    </form>
  </div>
  <?php
  }
  else{
    ?>
    <h2>PERFIL DE PROYECTO REVISADO</h2>
  <div class="container">


      <label for="tesis">TESIS:</label>
      <input type="text" id="tesis" name="tesis" value="<?=$titulo?>" readonly>
      

        <label for="fecha">Fecha   :</label>
        <input type="text" id="tesis" name="tesis" value="<?=$fecha?>" readonly>

      <label for="estado">Estado   :</label>
      <input type="text" id="tesis" name="tesis" value="<?=$estado?>" readonly>
        

      <label for="observaciones">Observaciones:</label>
      <input type="text" id="tesis" name="tesis" value="<?=$obs?>" readonly>

    </form>
  </div>
    <a href="jurado.php?modulo=presentacion"><button  class="a-boton">Aceptar</button></a>
    <?php
  }
  ?>
</body>

</html>

