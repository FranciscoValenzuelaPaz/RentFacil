<style>
  <?php include("../CSS/crudAdminEstacionamiento.css"); ?>
</style>

<body class="fondoformulario">
  <div class="container">
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

      if (mensaje == "registrado") {
        Swal.fire({
          html: `
                    <p style="text-align:justify;">Estacionamiento Registrado con éxito.</p>
                    `,
        });
      }
      if (mensaje == "error_registrar") {
        Swal.fire({
          html: `
                    <p style="text-align:justify;">Error al Registrar Estacionamiento. Porfavor vuelve a intentarlo.</p>
                    `,
        });
      }
      if (mensaje == "editado") {
        Swal.fire({
          html: `
                    <p style="text-align:justify;">Estacionamiento editado con éxito.</p>
                    `,
        });
      }
      if (mensaje == "error_editar") {
        Swal.fire({
          html: `
                    <p style="text-align:justify;">Error al Editar el Estacionamiento. Porfavor vuelve a intentarlo.</p>
                    `,
        });
      }
      if (mensaje == "eliminado") {
        Swal.fire({
          html: `
                    <p style="text-align:justify;">Estacionamiento eliminado con éxito.</p>
                    `,
        });
      }
      if (mensaje == "error_eliminar") {
        Swal.fire({
          html: `
                    <p style="text-align:justify;">Error al Eliminar el Estacionamiento. Porfavor vuelve a intentarlo.</p>
                    `,
        });
      }
    </script>
    <div>
      <div">
        <div class="fs-3 titulo">REGISTRAR ESTACIONAMIENTO</div>
        <button type="button" class="btn btn-success" onclick="location='registrarEstacionamiento.php?id_usuario=<?php echo $id_usuario ?>'">Registrar</button>
        <?php
        //array con informacion de las direcciones del usuario
        $arrayEstacionamientos = array();
        $stmt = $dbh->prepare("SELECT U.nombre,U.apellido,E.titulo,E.id_estacionamiento,E.descripcion,E.fecha,E.ubicacion,E.id_comuna,
        E.montoArriendo,E.montoArriendo2,E.link_foto,E.estado FROM tabla_estacionamientos as E JOIN tabla_usuario as U ON 
        E.id_usuario=U.id_usuario WHERE  E.eliminado=FALSE");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
          $arrayEstacionamientos[] = $row;
        }
        // print_r($arrayEstacionamientos);


        $arrayEstado = array('Dummy', "Disponible", "Arrendado");
        ?>

        <?php if (!empty($arrayEstacionamientos)) { ?>
          <div class="fs-3 titulo">LISTA DE ESTACIONAMIENTOS</div>
          <button class="btn btn-success" onclick="location='crudEstacionamiento.php?id_usuario=<?php echo $id_usuario ?>'">Actualizar Registros</button>
          <div class="table-responsive">
            <div>
              <table class="table table-hover label tamanoCrud">
                <thead>
                  <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Título</th>
                    <th scope="col">Fecha de Publicación</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Región/Ciudad/Comuna</th>
                    <th scope="col">Monto de Arriendo x Día</th>
                    <th scope="col">Monto de Arriendo x Hora</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
                  <?php foreach ($arrayEstacionamientos as $estacionamiento) { ?> <!--obtengo la fila del resultado-->
                </thead>
                <tbody class="table-group-divider">
                  <tr class="fila">
                    <td>
                      <div><?php $nombre = $estacionamiento['nombre'] . " " . $estacionamiento['apellido'];
                                          echo $nombre; ?></div>
                    </td>
                    <td>
                      <div><?php echo $estacionamiento['titulo']; ?></div>
                    </td> <!--retorno de mysql-->
                    <td>
                      <div class=""><?php echo $estacionamiento['fecha']; ?></div>
                    </td>
                    <td>
                      <div><?php echo $estacionamiento['ubicacion']; ?></div>
                    </td>
                    <td>
                      <div>
                        <?php
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
                        echo $ubicacionFinal;
                        ?>
                      </div>
                    </td>
                    <td>
                      <div class=""><?php echo "$" . $estacionamiento['montoArriendo']; ?></div>
                    </td>
                    <td>
                      <div class=""><?php echo "$" . $estacionamiento['montoArriendo2']; ?></div>
                    </td>
                    <td><a href="<?php echo $estacionamiento['link_foto']; ?>" target="_blank"><img src="<?php echo $estacionamiento['link_foto']; ?>" alt="fotoEstacionamientoUsuario" width="150" height="120"></a></td>
                    <td>
                      <div class="descripcion overflow-y-scroll"><?php echo $estacionamiento['descripcion']; ?></div>
                    </td>
                    <td>
                      <div><?php echo $arrayEstado[$estacionamiento['estado']]; ?>
                    </td>
                    <td><a href="editarEstacionamiento.php?id_usuario=<?php echo $id_usuario; ?>&id_estacionamiento=<?php echo $estacionamiento['id_estacionamiento']; ?>&link=<?php echo $estacionamiento['link_foto']; ?>"><button class="btn btn-success">Editar</button></a></td>
                    <td><a href="eliminar.php?id_usuario=<?php echo $id_usuario; ?>&id_estacionamiento=<?php echo $estacionamiento['id_estacionamiento']; ?>&link=<?php echo $estacionamiento['link_foto']; ?>"><button class="btn btn-danger" onclick="return confirm('¿Está Segur@ de eliminar este Registro?')">Eliminar</button></a></td>
                  </tr>

                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
    </div>
  </div>
<?php } else { ?>
  <div class="fs-3 margen">No se encuentrar Estacionamientos Registrados</div>
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