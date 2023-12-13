<style>
  <?php include("../../CSS/estadoServicios.css"); ?><?php include("../../Header-Footer/header6.php"); ?>
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

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Servicio de Estados</title>
</head>

<script>
  var mensaje = "<?php echo $mensaje; ?>";
  if (mensaje == "editado_maquinaria") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Estado de Maquinaria editado con éxito.</p>
    //                 `,
    // });
    alert("Estado de Maquinaria editado con éxito.")
  }
  if (mensaje == "error_editado_maquinaria") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Error al Editar el Estado de Maquinaria. Porfavor vuelve a intentarlo.</p>
    //                 `,
    // });
    alert("Error al Editar el Estado de Maquinaria. Porfavor vuelve a intentarlo.")
  }
  if (mensaje == "editado_estacionamiento") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Estado de Estacionamiento editado con éxito.</p>
    //                 `,
    // });
    alert("Estado de Estacionamiento editado con éxito.")
  }
  if (mensaje == "error_editado_estacionamiento") {
    // Swal.fire({
    //   html: `
    //                 <p style="text-align:justify;">Error al Editar el Estado de Estacionamiento. Porfavor vuelve a intentarlo.</p>
    //                 `,
    // });
    alert("Error al Editar el Estado de Estacionamiento. Porfavor vuelve a intentarlo.")
  }
</script> 

<body>
  <div class="container_Estado">
  <div class="fs-2 mb-1 mt-5"><i class="fa-solid fa-file-pen fa-beat-fade"></i> ESTADOS DE SERVICIOS</div>
    <div class="row justify-content-center m-3">
      <div class="col-11 bm mt-5 mb-5">
        <div>
          <?php
          //consulta para traer los datos de todas las maquinarias.
          $arrayMaquinariasUsuario = array();
          $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias WHERE id_usuario = '$id_usuario_original' AND eliminado=FALSE");
          // Especificamos el fetch mode antes de llamar a fetch()
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
          // Ejecutamos
          $stmt->execute();
          // Mostramos los resultados
          while ($row = $stmt->fetch()) {
            $arrayMaquinariasUsuario[] = $row;
          }
          ?>
          <div class="fs-3 mt-5">MAQUINARIAS</div>
          <?php if (count($arrayMaquinariasUsuario) > 0) {  ?>
            <div class="tabla mb-5">
              <div class="table-responsive mt-3">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Maquinaria</th>
                      <th scope="col">Descripción</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Contrato</th>
                      <th scope="col">Cambiar Estado</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <?php foreach ($arrayMaquinariasUsuario as $maquinaria) {
                      $id_maquinaria = $maquinaria['id_maquinaria']; ?> <!--obtengo la fila del resultado-->
                      <tr class="fila">
                        <td><?php echo $maquinaria['titulo']; ?></td>
                        <td><?php echo $maquinaria['descripcion']; ?></td>
                        <td>
                          <?php
                          $switch = 0;
                          if ($maquinaria['estado'] == 1) {
                            $switch = 1;
                            echo 'Disponible';
                          } else {
                            echo 'Arrendado';
                          }
                          ?>
                        </td>
                        <?php
                        $estadoBoton = "";
                        if ($switch == 1) {
                          $estadoBoton = "disabled";
                        }
                        $tipo_servicio = 1;
                        ?>
                        <td>
                          <?php
                          #CONTRATO
                          $estadoContrato = '';
                          $stmt = $dbh->prepare("SELECT estado FROM tabla_contratos WHERE id_usuario_publicacion = '$id_usuario_original' AND tipo_servicio='$tipo_servicio' AND id_servicio='$id_maquinaria' AND eliminado=FALSE");
                          // Especificamos el fetch mode antes de llamar a fetch()
                          $stmt->setFetchMode(PDO::FETCH_ASSOC);
                          // Ejecutamos
                          $stmt->execute();
                          // Mostramos los resultados
                          while ($row = $stmt->fetch()) {
                            $estadoContrato = $row['estado'];
                          }
                          if ($estadoContrato != '') {
                            if ($estadoContrato == 1) {
                              echo 'PENDIENTE';
                            } else {
                              echo 'PAGADO';
                            }
                          } else {
                            echo 'NO REGISTRA EN CONTRATO';
                          }
                          ?>
                        </td>
                        <td><a class="btn btn-success <?php echo $estadoBoton; ?>" href="cambiarEstado.php?id_usuario=<?php echo $id_usuario; ?>&id_servicio=<?php echo $maquinaria['id_maquinaria']; ?>&tipo_servicio=<?php echo $tipo_servicio; ?>">Cambiar Estado</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php } else {  ?>
            <div class="fs-5 mb-5">No existen Registros de Maquinarias.</div>
          <?php }  ?>
        </div>
      </div>

      <div class="container">
        <div class="row justify-content-center">

          <div class="col-11 bm mt-3 mb-5">
            <div class="estacionamientos">
              <?php
              //consulta para traer los datos de todos los Estacionamientos
              $arrayEstacionamientosUsuario = array();
              $stmt = $dbh->prepare("SELECT * FROM tabla_estacionamientos WHERE id_usuario = '$id_usuario_original' AND eliminado=FALSE");
              // Especificamos el fetch mode antes de llamar a fetch()
              $stmt->setFetchMode(PDO::FETCH_ASSOC);
              // Ejecutamos
              $stmt->execute();
              // Mostramos los resultados
              while ($row = $stmt->fetch()) {
                $arrayEstacionamientosUsuario[] = $row;
              }
              ?>
              <div class="fs-3 mt-5">ESTACIONAMIENTOS</div>
              <?php if (count($arrayEstacionamientosUsuario) > 0) {  ?>
                <div class="tabla mb-5">
                  <div class="table-responsive mt-3">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Estacionamiento</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Contrato</th>
                          <th scope="col">Cambiar Estado</th>
                        </tr>
                      </thead>
                      <tbody class="table-group-divider">
                        <?php foreach ($arrayEstacionamientosUsuario as $estacionamiento) {
                          $id_estacionamiento = $estacionamiento['id_estacionamiento'] ?> <!--obtengo la fila del resultado-->
                          <tr class="fila">
                            <td><?php echo $estacionamiento['titulo']; ?></td>
                            <td><?php echo $estacionamiento['descripcion']; ?></td>
                            <td>
                              <?php
                              $switch = 0;
                              if ($estacionamiento['estado'] == 1) {
                                $switch = 1;
                                echo 'Disponible';
                              } else {
                                echo 'Arrendado';
                              }
                              ?>
                            </td>
                            <?php
                            $estadoBoton = "";
                            if ($switch == 1) {
                              $estadoBoton = "disabled";
                            }
                            $tipo_servicio = 2;
                            ?>
                            <td>
                              <?php
                              #CONTRATO
                              $estadoContrato = '';
                              $stmt = $dbh->prepare("SELECT estado FROM tabla_contratos WHERE id_usuario_publicacion = '$id_usuario_original' AND tipo_servicio='$tipo_servicio' AND id_servicio='$id_estacionamiento' AND eliminado=FALSE");
                              // Especificamos el fetch mode antes de llamar a fetch()
                              $stmt->setFetchMode(PDO::FETCH_ASSOC);
                              // Ejecutamos
                              $stmt->execute();
                              // Mostramos los resultados
                              while ($row = $stmt->fetch()) {
                                $estadoContrato = $row['estado'];
                              }
                              if ($estadoContrato != '') {
                                if ($estadoContrato == 1) {
                                  echo 'PENDIENTE';
                                } else {
                                  echo 'PAGADO';
                                }
                              } else {
                                echo 'NO REGISTRA EN CONTRATO';
                              }
                              ?>
                            </td>
                            <td><a class="btn btn-success <?php echo $estadoBoton; ?>" href="cambiarEstado.php?id_usuario=<?php echo $id_usuario; ?>&id_servicio=<?php echo $estacionamiento['id_estacionamiento']; ?>&tipo_servicio=<?php echo $tipo_servicio; ?>">Cambiar Estado</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } else {  ?>
                <div class="fs-5 mb-5">No existen Registros de Estacionamientos.</div>
              <?php }  ?>
            </div>
          </div>
        </div>
      </div>
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
  </div>
  
</body>
<footer>
  <?php include("../../Header-Footer/footer2.php"); ?>
</footer>

</html>