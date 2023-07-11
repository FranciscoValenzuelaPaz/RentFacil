<style>
  <?php include("../../CSS/publicacionMaquinaria.css"); ?>
</style>

<body class="body">
  <div class="container contenedor">
    <?php
    include("../../Header-Footer/header6.php");
    if (isset($_GET['id_usuario'])) {
      $id_usuario = $_GET['id_usuario'];
    } else {
      $id_usuario = '';
    }
    if (isset($_GET['mensaje'])) {
      $mensaje = $_GET['mensaje'];
    } else {
      $mensaje = '';
    }

    //filtros para busqueda
    $buscar1 = '';
    $buscar2 = '';
    $buscar3 = '';
    if (isset($_POST['btn_filtrar'])) {

      if (!empty($_POST['tipos'])) {
        $tipo = $_POST['tipos'];
        $buscar1 = "AND tipo='$tipo'";
      }
      if (!empty($_POST['bencinas'])) {
        $bencinas = $_POST['bencinas'];
        $buscar2 = "AND bencina='$bencinas'";
      }
      if (!empty($_POST['comunas'])) {
        $comunas = $_POST['comunas'];
        $buscar3 = "AND id_comuna='$comunas'";
      }
    }

    //consulta para traer los datos de todas las maquinarias.
    $arrayMaquinarias = array();
    $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias WHERE 1=1 $buscar1 $buscar2 $buscar3 AND estado=1 AND eliminado=FALSE");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()) {
      $arrayMaquinarias[] = $row;
    }
    //print_r($arrayMaquinarias);
    // $aux = "SELECT * FROM tabla_maquinarias WHERE 1=1 $buscar1 $buscar2 $buscar3 AND estado=1";
    // echo $aux;

    $tipo_servicio = 1;

    //arrays para reemplazar ids por nombres
    $arrayTipos = array("Dummy", "Excavadora", "Retroexcavadora", "Tractor", "Cargador Frontal", "Pavimentadora", "Compactadora", "Grua", "Hormigonera", "Rompepavimientos", "Retropala", "Generador");
    $arrayEstado = array("Dummy", "Disponible", "Arrendado");
    $arrayBencina = array("Dummy", "Con Combustible", "Sin Combustible");

    ?>
    <script>
         var mensaje = "<?php echo $mensaje; ?>";
        //  if(mensaje == "enviado"){
        //    Swal.fire({
        //      html: `
        //                    <p style="text-align:justify;">Límite de Direcciones alcanzado. Intenta Editar o Borrar una Dirección</p>
        //                    `,
        //    });

      //   }
        if(mensaje == "enviado"){
          Swal.fire({
                    html: `
                          <p style="text-align:justify;">Cotización Enviada con éxito.</p>
                          `,
                  });
        }
        if(mensaje == "error_enviar"){
          Swal.fire({
                    html: `
                          <p style="text-align:justify;">Error al Enviar Cotización. Porfavor vuelve a intentarlo.</p>
                          `,
                  });
        }
      //   if(mensaje == "editado"){
      //     Swal.fire({
      //               html: `
      //                     <p style="text-align:justify;">Dirección editada con éxito.</p>
      //                     `,
      //             });
      //     }
      //   if(mensaje == "error_editar"){
      //     Swal.fire({
      //               html: `
      //                     <p style="text-align:justify;">Error al Editar la dirección. Porfavor vuelve a intentarlo.</p>
      //                     `,
      //             });
      //   }
      //   if(mensaje == "eliminado"){
      //     Swal.fire({
      //               html: `
      //                     <p style="text-align:justify;">Dirección eliminada con éxito.</p>
      //                     `,
      //             });
      //   }
      //   if(mensaje == "error_eliminar"){
      //     Swal.fire({
      //               html: `
      //                     <p style="text-align:justify;">Error al Eliminar la dirección. Porfavor vuelve a intentarlo.</p>
      //                     `,
      //             });
      //   }
    </script>
    <html>
    <div class="filtros">
      <form class="d-flex" role="search" method="POST">
        <div class="txtFiltro">Filtros:</div>&nbsp;&nbsp;
        <select class="form-select" aria-label="Default select example" name='tipos' id="tipos">
          <option value="" selected>Tipos</option>
          <?php
          $arrayTipos = array("Dummy", "Excavadora", "Retroexcavadora", "Tractor", "Cargador Frontal", "Pavimentadora", "Compactadora", "Grua", "Hormigonera", "Rompepavimientos", "Retropala", "Generador");
          for ($i = 1; $i < count($arrayTipos); $i++) {
            echo '<option value="' . $i . '">' . $arrayTipos[$i] . '</option>';
          }
          ?>
        </select>&nbsp;&nbsp;
        <select class="form-select" aria-label="Default select example" name='bencinas' id="bencinas">
          <option value="" selected>Con/Sin Combustible</option>
          <option value="1">Con Combustible</option>
          <option value="2">Sin Combustible</option>
        </select>&nbsp;&nbsp;
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
        <button class="btn btn-success" onclick="location='publicacionMaquinaria.php?id_usuario=<?php echo $id_usuario ?>'">Refrescar</button>
      </form>
    </div>

    <?php if (count($arrayMaquinarias) > 0) {
      foreach ($arrayMaquinarias as $maquinaria) {

        //array para traer Region/Ciudad/Comuna 
        $id_comuna = $maquinaria['id_comuna'];
        $arrayUbicacion = array();
        $stmt = $dbh->prepare("SELECT M.id_comuna,Comuna.nombre_comuna,Ciudad.nombre_ciudad,Region.nombre_region FROM tabla_maquinarias as M 
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
        // echo $ubicacionFinal;     

    ?>
        <div class="card fondo2">
          <div class="jumbotron caja ">
            <h1 class="fs-2"><?php echo $maquinaria['titulo']; ?></h1>
            <div><img src="<?php echo $maquinaria['link_foto']; ?>" alt="FotoPublicacion" class="img-fluid margen2 imagen "></div>

            <p>Ubicación: <?php echo $ubicacionFinal . "/ " . $maquinaria['ubicacion']; ?></p>
            <p>Tipo: <?php echo $arrayTipos[$maquinaria['tipo']]; ?></p>
            <p>Estado: <?php echo $arrayEstado[$maquinaria['estado']]; ?></p>
            <p>Combustible: <?php echo $arrayBencina[$maquinaria['bencina']]; ?></p>
            <p>Fecha de Publicación: <?php echo $maquinaria['fecha']; ?></p>
            <p><?php echo "Monto Arriendo x Día: $" . $maquinaria['montoArriendo']; ?></p>
            <!-- OJO -->
            <!-- OJO -->
            <!-- OJO -->
            <!-- OJO -->
            <!-- OJO -->
            <p><?php echo "Descripción: ".$maquinaria['descripcion']; ?></p>
            <!-- OJO -->
            <!-- OJO -->
            <!-- OJO -->
            <!-- OJO -->
            <!-- OJO -->

            <div class="d-flex">
              <div><?php if ($maquinaria['id_usuario'] != $id_usuario) { ?>
                <a class="btn btn-success btn-lg margen" href="../../cotizaciones/formularioCotizar.php?id_maquinaria=<?php echo $maquinaria['id_maquinaria']; ?>
                &tipo_servicio=<?php echo $tipo_servicio; ?>&id_usuario=<?php echo $id_usuario; ?>" role="button">Cotizar</a></div>
                <?php }else{ ?>
                <a class="btn btn-success btn-lg margen disabled" href="#" role="button">Cotizar</a></div>
                <?php } ?>

              <div><?php if ($maquinaria['id_usuario'] != $id_usuario) { ?>
                <a class="btn btn-success btn-lg margen" href="../../contratos/formularioContrato.php?id_maquinaria=<?php echo $maquinaria['id_maquinaria']; ?>
                &tipo_servicio=<?php echo $tipo_servicio; ?>&id_usuario=<?php echo $id_usuario; ?>" role="button">Contratar</a></div>
                <?php }else{ ?>  
                  <a class="btn btn-success btn-lg margen disabled" href="#" role="button">Contratar</a></div>
                  <?php } ?>
              <div><?php if ($maquinaria['id_usuario'] == $id_usuario) { ?>
                  <a class="btn btn-success btn-lg margen" href="Usuario/crudMaquinaria.php?id_usuario=<?php echo $id_usuario; ?>" role="button">Editar</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
    <?php }
    } else {
      echo "<div class='fs-2 nohaypublicacion'>No hay Publicaciones</div>";
    } ?>
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
  </div>
</body>

</html>