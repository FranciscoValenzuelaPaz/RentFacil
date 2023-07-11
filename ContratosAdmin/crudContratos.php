<style>
  <?php include("../CSS/crudAdminContratos.css"); ?>
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
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Límite de Direcciones alcanzado. Intenta Editar o Borrar una Dirección</p>
                    `,
    });

  }
  if (mensaje == "registrado") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Contrato Registrado con éxito.</p>
                    `,
    });
  }
  if (mensaje == "error_registrar") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Error al Registrar Contrato. Porfavor vuelve a intentarlo.</p>
                    `,
    });
  }
  if (mensaje == "editado") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Contrato editado con éxito.</p>
                    `,
    });
  }
  if (mensaje == "error_editar") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Error al Editar Contrato. Porfavor vuelve a intentarlo.</p>
                    `,
    });
  }
  if (mensaje == "eliminado") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Contrato eliminado con éxito.</p>
                    `,
    });
  }
  if (mensaje == "error_eliminar") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Error al Eliminar Contrato. Porfavor vuelve a intentarlo.</p>
                    `,
    });
  }
</script>
<html>

<body>
  <?php
$arrayTipos = array("Dummy","Maquinaria","Estacionamiento");

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
  $arrayContratos = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_contratos WHERE eliminado = FALSE ");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayContratos[] = $row;
  }

  ?>
  <div>
    <?php if (!empty($arrayContratos)) { ?>
      <div class="fs-3 titulo margen">LISTA DE CONTRATOS</div>
      <div class="titulo margen2">
        <button class="btn btn-success " onclick="location='crudContratos.php?id_usuario=<?php echo $id_usuario; ?>'">Actualizar Registros</button>
      </div>
      <div class="tabla tamanoCrud">
        <div class="table-responsive ">
          <table class="table table-hover label">
            <thead>
              <tr>
                <th scope="col">Usuario Publicación</th>
                <th scope="col">Usuario Contratante</th>
                <th scope="col">Tipo Servicio</th>
                <th scope="col">Fecha Contrato</th>
                <th scope="col">Fecha Desde</th>
                <th scope="col">Fecha Hasta</th>
                <th scope="col">Total</th>
                <th scope="col">Eliminar</th>
              </tr>
              </thead>
              <tbody class="table-group-divider label">
              <?php foreach ($arrayContratos as $contrato) { ?> <!--obtengo la fila del resultado-->
              <tr class="fila">
                <td>
                  <?php
                    foreach($arrayUsuarios as $usuario){
                      if($contrato['id_usuario_publicacion'] == $usuario['id_usuario']){
                        echo $usuario['nombre']." ".$usuario['apellido'];
                      }
                    }
                  ?> 
                </td>
                <td>
                  <?php
                    foreach($arrayUsuarios as $usuario){
                      if($contrato['id_usuario_contratante'] == $usuario['id_usuario']){
                        echo $usuario['nombre']." ".$usuario['apellido'];
                      }
                    }
                  ?> 
                </td>
                <td><?php echo $arrayTipos[$contrato['tipo_servicio']] ; ?> </td>
                <td><?php echo $contrato['fecha_contrato']; ?> </td>
                <td><?php echo $contrato['fecha_desde']; ?> </td>
                <td><?php echo $contrato['fecha_hasta']; ?> </td>
                <td><?php echo "$".$contrato['total']; ?> </td>
                <td><a href="eliminar.php?id_usuario=<?php echo $id_usuario; ?>&id_contrato=<?php echo $contrato['id_contrato']; ?>"><button class="btn btn-danger" onclick="return confirm('¿Está Segur@ de eliminar este Registro?')">Eliminar</button></a></td>
              </tr>
          <?php } ?>
          </tbody>
          </table>
        </div>
      </div>
  </div>
<?php } else { ?>
  <div class="fs-3">¡No se encuentran Contratos Registrados!</div>

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