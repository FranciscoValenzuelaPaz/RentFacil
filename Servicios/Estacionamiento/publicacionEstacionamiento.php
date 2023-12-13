<style>
  <?php include("../../CSS/publicacionEstacionamiento.css"); ?><?php include("../../Header-Footer/header6.php"); ?>
</style>

<?php
include("../../encriptarContrasena/encriptarClave.php");

if (isset($_GET['id_usuario'])) {
  $id_usuario = $_GET['id_usuario'];
  $id_usuario_original = $desencriptar($id_usuario);
} else {
  $id_usuario = '';
  $id_usuario_original = '';
}
if (isset($_GET['mensaje'])) {
  $mensaje = $_GET['mensaje'];
} else {
  $mensaje = '';
}

$tipo_servicio = 2;
//filtros para busqueda
$buscar1 = '';


if (isset($_POST['btn_filtrar'])) {

  if (!empty($_POST['comunas'])) {
    $comunas = $_POST['comunas'];
    $buscar1 = "AND id_comuna='$comunas'";
  }
}
//consulta para traer los datos de todas las maquinarias.
$arrayEstacionamiento = array();
$stmt = $dbh->prepare("SELECT * FROM tabla_estacionamientos WHERE 1=1 $buscar1 AND estado=1 AND eliminado=FALSE");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
while ($row = $stmt->fetch()) {
  $arrayEstacionamiento[] = $row;
}
//print_r($arrayMaquinarias);

//arrays para reemplazar ids por nombres
$arrayEstado = array("Dummy", "Disponible", "Arrendado");

?>
<html>

<body>

  <script>
    //   var mensaje = "<?php echo $mensaje; ?>";

    if (mensaje == "contrato_enviado") {
      // Swal.fire({
      //   html: `
      //                     <p style="text-align:justify;">Contrato enviado con éxito.</p>
      //                     `,
      // });
      alert("Contrato enviado con éxito.")
    }
    if (mensaje == "error_contrato_enviar") {
      // Swal.fire({
      //   html: `
      //                     <p style="text-align:justify;">Error al Enviar el Contrato. Porfavor vuelve a intentarlo.</p>
      //                     `,
      // });
      alert("Error al Enviar el Contrato. Porfavor vuelve a intentarlo.")
    }
  </script>

  <div class="container">
    <div class="filtros">
      <form class="d-flex" role="search" method="POST">
        <div class="txtFiltro">Filtros:</div>&nbsp;&nbsp;
        <select class="form-select" aria-label="Default select example" name='comunas' id="comunas">
          <option value="" selected>Comunas</option>
          <?php
          $stmt = $dbh->prepare("SELECT * FROM tabla_comunas");
          // Especificamos el fetch mode antes de llamar a fetch()
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          // Ejecutamos
          $stmt->execute();
          // Mostramos los resultados
          while ($row = $stmt->fetch()) {
            echo '<option value="' . $row['id_comuna'] . '">' . $row['nombre_comuna'] . '</option>';
          }
          ?>
        </select>&nbsp;&nbsp;

        <button class="btn btn-success" name="btn_filtrar" type="submit">Filtrar</button>&nbsp;&nbsp;
        <button class="btn btn-success" onclick="location='publicacionEstacionamiento.php?id_usuario=<?php echo $id_usuario ?>'">Refrescar</button>
      </form>
    </div>

    <?php if (count($arrayEstacionamiento) > 0) {
      foreach ($arrayEstacionamiento as $estacionamiento) {
        //array para traer Region/Ciudad/Comuna 
        $id_comuna = $estacionamiento['id_comuna'];
        $arrayUbicacion = array();
        $stmt = $dbh->prepare("SELECT M.id_comuna,Comuna.nombre_comuna,Ciudad.nombre_ciudad,Region.nombre_region FROM tabla_estacionamientos as M 
    JOIN tabla_comunas as Comuna ON M.id_comuna=Comuna.id_comuna JOIN tabla_ciudades as Ciudad ON Comuna.id_ciudad=Ciudad.id_ciudad JOIN    
    tabla_regiones as Region ON Ciudad.id_region=Region.id_region WHERE M.id_comuna='$id_comuna'");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
          $arrayUbicacion[] = $row;
        }
        foreach ($arrayUbicacion as $ubicacion) {
          $ubicacionFinal = $ubicacion['nombre_region'] . " / " . $ubicacion['nombre_ciudad'] . " / " . $ubicacion['nombre_comuna'];
        }
    ?>

        <div class="card">
          <div class="jumbotron">
            <h1 class="fs-1 titulo"><?php echo $estacionamiento['titulo']; ?></h1>
            <div><img src="<?php echo $estacionamiento['link_foto']; ?>" alt="FotoPublicacion" class="img-fluid imagen"></div>

            <p>Ubicación: <?php echo $ubicacionFinal . " / " . $estacionamiento['ubicacion']; ?></p>
            <p>Estado: <?php echo $arrayEstado[$estacionamiento['estado']]; ?></p>
            <p>Fecha de Publicación: <?php echo $estacionamiento['fecha']; ?></p>
            <p><?php echo "Descripción: " . $estacionamiento['descripcion']; ?></p>
            <p><?php echo "Monto Arriendo x Día: $" . $estacionamiento['montoArriendo']; ?></p>
            <p><?php echo "Monto Arriendo x Hora: $" . $estacionamiento['montoArriendo2']; ?></p>

            <div class="row mb-3 mt-5">
              <div class="col-md-4">
                <div class="custom-column">
                  <div class="form-group">
                    <?php if ($estacionamiento['id_usuario'] != $id_usuario_original) { ?>
                      <a class="btn btn-success btn-lg" href="../../contratos/formularioContrato.php?id_estacionamiento=<?php echo $estacionamiento['id_estacionamiento']; ?>&tipo_servicio=<?php echo $tipo_servicio; ?>&id_usuario=<?php echo $id_usuario; ?>" role="button">Contratar</a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-column">
                  <div class="form-group">
                  <?php } else { ?>
                    <a class="btn btn-outline-success btn-lg disabled" href="#" role="button">Contratar</a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-column">
                  <div class="form-group">
                  <?php } ?>
                  <?php if ($estacionamiento['id_usuario'] == $id_usuario_original) { ?>
                    <a class="btn btn-success btn-lg" href="Usuario/crudestacionamiento.php?id_usuario=<?php echo $id_usuario; ?>" role="button">Editar</a>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php }
    } else {
      echo "<div class='fs-2' nohaypublicacion >No hay Publicaciones</div>";
    } ?>
  </div>
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>
<footer>
  <?php include("../../Header-Footer/footer4.php"); ?>
</footer>
</html>