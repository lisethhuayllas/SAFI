<?php require_once('../controladores/jurado/jurado_controlador.php'); 
$datos=juradoControlador::mostrarTesisSustentacion();
if (isset($_GET['ID'])) {
  $Idtesis = ($_GET['ID']);
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
  juradoControlador::fecha_sustentacion();
  $enviado=true;
  
  $lugar=$_POST['lugar'];
  $hora=$_POST['hora'];
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
  <!-- Se necesitan, 	ID_sustentacion,	lugar,	fecha_sustentacion,	hora,	estado,	calificacion,	proyecto	 -->
   <!-- Se necesitan, 	NULL,	lugar,	fecha_sustentacion,	hora,	estado('pendiente'),	calificacion(0),	proyecto($id)	 -->
  <h2>DEFINIR FECHA DE SUSTENTACION</h2>
  <div class="container">
    <form id="contact" action="" method="post">
      <input type="hidden" id="id_trabajo" name="id_trabajo" value="<?=$id?>" readonly>
      <input type="hidden" id="DNI" name="DNI" value="<?=$Idjurado?>" readonly> 

      <label for="tesis">TESIS:</label>
      <input type="text" id="tesis" name="tesis" value="<?=$titulo?>" readonly>

      <label for="lugar">LUGAR:</label>
      <input type="text" id="lugar" name="lugar" value="">
      
      <div class="fecha-container">
        <label for="fecha">Fecha :</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo date("Y-m-d"); ?>">

        <label for="hora">Hora :</label>
        <input type="time" id="hora" name="hora" value="">
      </div>
      <br>

      <input type="submit" name="submit" value="Enviar">
    </form>
  </div>
  <?php
  }
  else{
    ?>
    <h2>FECHA DE SUSTENTACION DEFINIDA</h2>
  <div class="container">


      <label for="tesis">TESIS:</label>
      <input type="text" id="tesis" name="tesis" value="<?=$titulo?>" readonly>

      <label for="lugar">LUGAR:</label>
      <input type="text" id="lugar" name="lugar" value="<?=$lugar?>" readonly>
      

      <label for="fecha">Fecha   :</label>
      <input type="text" id="fecha" name="fecha" value="<?=$fecha?>" readonly>

      <label for="hora">Hora  :</label>
      <input type="text" id="hora" name="hora" value="<?=$hora?>" readonly>
  </div>
    <a href="jurado.php?modulo=sustentacion"><button class="a-boton">Aceptar</button></a>
    <?php
  }
  ?>
</body>

</html>

