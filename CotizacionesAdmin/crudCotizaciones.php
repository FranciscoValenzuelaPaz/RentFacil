<style>
  <?php include("../CSS/crudCotizaciones.css"); ?>
</style>
<?php
include("../Header-Footer/header4.php");
if (isset($_GET['id_usuario'])) {
  $id_usuario = $_GET['id_usuario'];
} else {
  if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
  } else {
    $id_usuario = '';
  }
}
if (isset($_GET['mensaje'])) {
  $mensaje = $_GET['mensaje'];
} else {
  $mensaje = '';
}
?>
<script>
  var mensaje = "<?php echo $mensaje; ?>";
  if (mensaje == "max_direcciones") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Límite de Direcciones alcanzado. Intenta Editar o Borrar una Dirección</p>
    //                 `,
    // });
    alert("Límite de Direcciones alcanzado. Intenta Editar o Borrar una Dirección")

  }
  if (mensaje == "registrado") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Cotización Registrada con éxito.</p>
    //                 `,
    // });
    alert("Cotización Registrada con éxito.")
  }
  if (mensaje == "error_registrar") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Error al Registrar Cotización. Porfavor vuelve a intentarlo.</p>
    //                 `,
    // });
    alert("Error al Registrar Cotización. Porfavor vuelve a intentarlo.")
  }
  if (mensaje == "editado") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Cotización editada con éxito.</p>
    //                 `,
    // });
    alert("Cotización editada con éxito.")
  }
  if (mensaje == "error_editar") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Error al Editar Cotización. Porfavor vuelve a intentarlo.</p>
    //                 `,
    // });
    alert("Error al Editar Cotización. Porfavor vuelve a intentarlo.")
  }
  if (mensaje == "eliminado") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Cotización eliminada con éxito.</p>
    //                 `,
    // });
    alert("Cotización eliminada con éxito.")
  }
  if (mensaje == "error_eliminar") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Error al Eliminar Cotización. Porfavor vuelve a intentarlo.</p>
    //                 `,
    // });
    alert("Error al Eliminar Cotización. Porfavor vuelve a intentarlo.")
  }
</script>
<html>

<body class="fondoformulario ">
  <?php
  $arrayTipos = array("Dummy", "Maquinaria", "Estacionamiento");

  //array con informacion de los usuarios
  $arrayUsuarios = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_usuario");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayUsuarios[] = $row;
  }


  //array con informacion de las direcciones del usuario
  $arrayCotizaciones = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_cotizaciones WHERE eliminado = FALSE ");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayCotizaciones[] = $row;
  }
  ?>
  <div>
    <?php if (!empty($arrayCotizaciones)) { ?>
      <div class="fs-3 margen">LISTA DE COTIZACIONES</div>
      <div class="margen2">
        <button class="btn btn-success" onclick="location='crudCotizaciones.php?id_usuario=<?php echo $id_usuario; ?>'">Actualizar Registros</button>
      </div>
      <div class="tabla tamanoCrud">
        <div class="table-responsive">
          <table class="table table-hover label tamanoCrud">
            <thead>
              <tr>
                <th scope="col">Usuario Publicación</th>
                <th scope="col">Usuario Cotización</th>
                <th scope="col">Tipo Servicio</th>
                <th scope="col">Fecha Cotización</th>
                <th scope="col">Fecha Desde</th>
                <th scope="col">Fecha Hasta</th>
                <th scope="col">Total</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php foreach ($arrayCotizaciones as $cotizacion) { ?> <!--obtengo la fila del resultado-->
                <tr class="fila">
                  <td>
                    <?php
                    foreach ($arrayUsuarios as $usuario) {
                      if ($cotizacion['id_usuario_publicacion'] == $usuario['id_usuario']) {
                        echo $usuario['nombre'] . " " . $usuario['apellido'];
                      }
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    foreach ($arrayUsuarios as $usuario) {
                      if ($cotizacion['id_usuario_cotizacion'] == $usuario['id_usuario']) {
                        echo $usuario['nombre'] . " " . $usuario['apellido'];
                      }
                    }
                    ?>
                  </td>
                  <td><?php echo $arrayTipos[$cotizacion['tipo_servicio']]; ?> </td>
                  <td><?php echo $cotizacion['fecha_cotizacion']; ?> </td>
                  <td><?php echo $cotizacion['fecha_desde']; ?> </td>
                  <td><?php echo $cotizacion['fecha_hasta']; ?> </td>
                  <td><?php echo "$" . $cotizacion['total']; ?> </td>
                  <td><a href="eliminar.php?id_usuario=<?php echo $id_usuario; ?>&id_cotizacion=<?php echo $cotizacion['id_cotizacion']; ?>"><button class="btn btn-danger" onclick="return confirm('¿Está Segur@ de eliminar este Registro?')">Eliminar</button></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>
<?php } else { ?>
  <div class="fs-3">¡No se encuentran Cotizaciones Registradas!</div>

<?php } ?>
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      -->
</div>
</body>

</html>