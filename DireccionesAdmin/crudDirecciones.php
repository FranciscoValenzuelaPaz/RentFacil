<style>
  <?php include("../CSS/crudAdminDirecciones.css"); ?>
</style>
<html>

<body class="fondoformulario ">
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
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Límite de Direcciones alcanzado. Intenta Editar o Borrar una Dirección</p>
                    `,
      });

    }
    if (mensaje == "registrado") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Dirección Registrada con éxito.</p>
                    `,
      });
    }
    if (mensaje == "error_registrar") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Error al Registrar Dirección. Porfavor vuelve a intentarlo.</p>
                    `,
      });
    }
    if (mensaje == "editado") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Dirección editada con éxito.</p>
                    `,
      });
    }
    if (mensaje == "error_editar") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Error al Editar la dirección. Porfavor vuelve a intentarlo.</p>
                    `,
      });
    }
    if (mensaje == "eliminado") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Dirección eliminada con éxito.</p>
                    `,
      });
    }
    if (mensaje == "error_eliminar") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Error al Eliminar la dirección. Porfavor vuelve a intentarlo.</p>
                    `,
      });
    }
  </script>

  <div class="fs-2 margen">REGISTRAR DIRECCIONES</div>
  <div class="margen2">
    <button type="button" class="btn btn-success" onclick="location='registrarDireccion.php?id_usuario=<?php echo $id_usuario ?>'">Registrar</button>
  </div>
  <?php
  //array con informacion de las direcciones del usuario
  $arrayDirecciones = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_direcciones as D JOIN tabla_regiones as R ON D.id_region=R.id_region JOIN tabla_ciudades as Ci 
  ON D.id_ciudad=Ci.id_ciudad JOIN tabla_comunas as Cu ON D.id_comuna = Cu.id_comuna JOIN tabla_usuario as U ON D.id_usuario=U.id_usuario WHERE 
  D.eliminado = FALSE ");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayDirecciones[] = $row;
  }
  //print_r($arrayDirecciones);

  $arrayTipoDireccion = array("Dummy", "Empresa", "Domicilio", "Estacionamiento", "Obra");
  ?>
  <div>
    <?php if (!empty($arrayDirecciones)) { ?>
      <div class="fs-2 margen">LISTA DE DIRECCIONES</div>
      <div class="margen2">
        <button class="btn btn-success" onclick="location='crudDirecciones.php?id_usuario=<?php echo $id_usuario; ?>'">Actualizar Registros</button>
      </div>
      <div class="tabla">
        <div class="table-responsive ">
          <table class="table table-hover label tamanoCrud">
            <thead>
              <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Región</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Comuna</th>
                <th scope="col">Dirección</th>
                <th scope="col">Tipo</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php foreach ($arrayDirecciones as $direccion) { ?> <!--obtengo la fila del resultado-->
                <tr class="fila">
                  <td>
                    <?php
                    echo $direccion['nombre'] . " " . $direccion['apellido'];
                    ?>
                  </td>
                  <td><?php echo $direccion['nombre_region']; ?> </td> <!--retorno de mysql-->
                  <td><?php echo $direccion['nombre_ciudad']; ?> </td>
                  <td><?php echo $direccion['nombre_comuna']; ?> </td>
                  <td><?php echo $direccion['direccion']; ?> </td>
                  <td>
                    <?php
                    $aux = $direccion['tipo_direccion'];
                    echo $arrayTipoDireccion[$aux];
                    ?>
                  </td>
                  <td><a href="editarDireccion.php?id_usuario=<?php echo $id_usuario; ?>&id_direccion=<?php echo $direccion['id_direccion']; ?>"><button class="btn btn-success">Editar</button></a></td>
                  <td><a href="eliminar.php?id_usuario=<?php echo $id_usuario; ?>&id_direccion=<?php echo $direccion['id_direccion']; ?>"><button class="btn btn-danger" onclick="return confirm('¿Está Segur@ de eliminar este Registro?')">Eliminar</button></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>
<?php } else { ?>
  <div class="fs-3">¡No se encuentran Direcciones Registradas!</div>

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