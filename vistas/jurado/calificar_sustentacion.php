<?php require_once('../controladores/jurado/jurado_controlador.php'); 
$datos=juradoControlador::mostrarTesisSustentacion();
if (isset($_GET['ID'])) {
  $Idtesis = ($_GET['ID']);
  $data=juradoControlador::VerificarTesis($Idtesis);
  $IdSust=$data['ID_sustentacion'];
}

for($i=0; $i<mysqli_num_rows($datos) ;$i++) {
  $datosTesis=mysqli_fetch_array($datos);

  if($datosTesis['Id_proyecto']==$Idtesis){
    $Idjurado=$datosTesis['jurado'];
    $id=$datosTesis['Id_proyecto'];
    $titulo=$datosTesis['titulo'];
  }
}
$enviado=false;
if (isset($_POST['submit'])) {
  juradoControlador::RevisarTesisSustentacion();
  $enviado=true;
  
  $nota=$_POST['nota'];
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
  <h2>CALIFICAR INFORME DE TESIS</h2>
  <div class="container">
    <form id="contact" action="" method="post">
      <input type="hidden" id="id_trabajo" name="id_trabajo" value="<?=$id?>" readonly> 
      <input type="hidden" id="dni" name="dni" value="<?=$Idjurado?>" readonly>
      <input type="hidden" id="sust" name="sust" value="<?=$IdSust?>" readonly>

      <label for="tesis">TESIS:</label>
      <input type="text" id="tesis" name="tesis" value="<?=$titulo?>" readonly>
      
      <br>
      <!-- <div class="estado-container">
      <label for="estado">Estado   :</label>
        <select id="estado" name="estado">
          <option value="aprobado">Aprobado</option>
          <option value="desaprobado">Desaprobado</option>
        </select>
      </div> -->
      <label for="nota">CALIFICACION:</label>
      <input type="text" id="nota" name="nota" value="" oninput="validateInput(event)">
      <br>

      <input type="submit" name="submit" value="Enviar">
    </form>
  </div>
  <?php
  }
  else{
    ?>
    <h2>INFORME CALIFICADO</h2>
  <div class="container">


      <label for="tesis">TESIS:</label>
      <input type="text" id="tesis" name="tesis" value="<?=$titulo?>" readonly>

      <label for="estado">CALIFICACION   :</label>
      <input type="text" id="nota" name="nota" value="<?=$nota?>" readonly>

  </div>
    <a href="jurado.php?modulo=sustentacion"><button class="a-boton">Aceptar</button></a>
    <?php
  }
  ?>
</body>
<script>
  function validateInput(event) {
    const input = event.target;
    const value = input.value;

    if (!/^(0?[1-9]|1[0-9]|20)$/.test(value)) {
      input.value = value.slice(0, -1);
      alert("Por favor, introduce solo números entre 0 y 20.");
    }
  }
</script>
</html>

