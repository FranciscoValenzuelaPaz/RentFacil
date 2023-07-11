<style>
  <?php include("../CSS/crudAdminUsuarios.css"); ?>
</style>
<html>

<body class="fondoformulario margen ">
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
                    <p style="text-align:justify;">Usuario Registrado con éxito.</p>
                    `,
      });
    }
    if (mensaje == "error_registrar") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Error al Registrar Usuario. Porfavor vuelve a intentarlo.</p>
                    `,
      });
    }
    if (mensaje == "editado") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Usuario editada con éxito.</p>
                    `,
      });
    }
    if (mensaje == "error_editar") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Error al Editar Usuario. Porfavor vuelve a intentarlo.</p>
                    `,
      });
    }
    if (mensaje == "eliminado") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Usuario eliminado con éxito.</p>
                    `,
      });
    }
    if (mensaje == "error_eliminar") {
      Swal.fire({
        html: `
                    <p style="text-align:justify;">Error al Eliminar Usuario. Porfavor vuelve a intentarlo.</p>
                    `,
      });
    }
  </script>
  <?php
  $arrayEstados = array("Dummy", "Pendiente", "Desbloqueado", "Bloqueado");
  $arrayTipos = array("Dummy", "Normal", "Administrador");
  //array con informacion de las direcciones del usuario
  $arrayUsuario = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE eliminado = FALSE ");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayUsuario[] = $row;
  }

  ?>
  <div class="margen">
    <?php if (!empty($arrayUsuario)) { ?>
      <div class="fs-3 margen">LISTA DE USUARIOS</div>
      <div>
        <button class="btn btn-success" onclick="location='crudUsuarios.php?id_usuario=<?php echo $id_usuario; ?>'">Actualizar Registros</button>
      </div>
      <div class="tamanoCrud margen2">
        <div class="table-responsive ">
          <table class="table table-hover label ">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Rut</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Email</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php foreach ($arrayUsuario as $usuario) { ?> <!--obtengo la fila del resultado-->
                <tr class="fila">
                  <td><?php echo $usuario['nombre'] . " " . $usuario['apellido']; ?> </td> <!--retorno de mysql-->
                  <td><?php echo $usuario['rut']; ?> </td>
                  <td><?php echo $usuario['telefono']; ?> </td>
                  <td><?php echo $usuario['email']; ?> </td>
                  <td><?php echo $arrayEstados[$usuario['estado']]; ?> </td>
                  <td><?php echo $arrayTipos[$usuario['tipo']]; ?> </td>

                  <td><a href="editarUsuario.php?id_usuario=<?php echo $id_usuario; ?>&usuario=<?php echo $usuario['id_usuario']; ?>"><button class="btn btn-success">Editar</button></a></td>
                  <td><a href="eliminar.php?id_usuario=<?php echo $id_usuario; ?>&usuario=<?php echo $usuario['id_usuario']; ?>"><button class="btn btn-danger" onclick="return confirm('¿Está Segur@ de eliminar este Registro?')">Eliminar</button></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>
<?php } else { ?>
  <div class="fs-3">¡No se encuentran Usuarios Registradas!</div>

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