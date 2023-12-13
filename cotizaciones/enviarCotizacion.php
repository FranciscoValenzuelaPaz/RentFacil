<style>
  <?php include("../CSS/formularioCotizacion.css"); ?><?php include("../Header-Footer/header7.php"); ?>
</style>

<html>

<body>
  <?php
  require_once '../SendMail/config.php';
  require '../SendMail/vendor/autoload.php';
  include("../encriptarContrasena/encriptarClave.php");

  $arrayBencina = array("Con Bencina", "Sin Bencina");

  $id_usuario = $_POST['id_usuario'];
  $id_usuario_original = $desencriptar($id_usuario);

  $id_usuario_publicacion = $_POST['id_usuario_publicacion'];
  $id_servicio = $_POST['id_servicio'];
  $monto = $_POST['monto'];
  $tipo_servicio = $_POST['tipo_servicio'];
  $fecha_desde = $_POST['fecha_desde'];
  $fecha_hasta = $_POST['fecha_hasta'];
  $fecha = date("Y-m-d");

  //consulta para traer la información de la maquinaria seleccionada
  $arrayInfoMaquinaria = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias WHERE id_maquinaria='$id_servicio'");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayInfoMaquinaria[] = $row;
  }

  $titulo_maquinaria = $arrayInfoMaquinaria[0]['titulo'];
  $descripcion_maquinaria = $arrayInfoMaquinaria[0]['descripcion'];
  $bencina = $arrayInfoMaquinaria[0]['bencina'];
  $bencina = $arrayBencina[$bencina];
  $ubicacion_maquinaria = $arrayInfoMaquinaria[0]['ubicacion'];


  //consulta para traer la información del Usuario Cotizador seleccionada
  $arrayUsuario = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE id_usuario='$id_usuario_original'");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayUsuario[] = $row;
  }
  $correoUsuario = $arrayUsuario[0]['email'];
  $nombreUsuario = $arrayUsuario[0]['nombre'] . " " . $arrayUsuario[0]['apellido'];


  //array con informacion de las direcciones del usuario
  $arrayUbicacion = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias as M JOIN tabla_comunas as COMUNA ON M.id_comuna = COMUNA.id_comuna JOIN tabla_ciudades AS 
 CIUDAD ON COMUNA.id_ciudad = CIUDAD.id_ciudad JOIN tabla_regiones AS REGION ON CIUDAD.id_region=REGION.id_region WHERE M.id_maquinaria='$id_servicio'");
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



  $fecha1 = new DateTime($fecha_desde);
  $fecha2 = new DateTime($fecha_hasta);

  $diff = $fecha1->diff($fecha2);
  $diferencia = $diff->days;   //este numero se multiplica por el monto para calcular el total
  // echo  $diferencia;
  $total = $monto * $diferencia;



  //!!!CONDIONCIONAR QUE FECHA DESDE SEA MENOR A FECHA HASTA EN EL CORREO!!!


  //generamos consulta para actualizar los datos en la base de datos
  $sql = "INSERT INTO tabla_cotizaciones (id_usuario_publicacion, id_usuario_cotizacion ,id_servicio , tipo_servicio,
 fecha_cotizacion, fecha_desde, fecha_hasta, total) VALUES
( '$id_usuario_publicacion ', '$id_usuario_original', '$id_servicio', '$tipo_servicio', '$fecha', '$fecha_desde', '$fecha_hasta', '$total')";

  if ($dbh->exec($sql)) {
    //consultamos a la base de datos por el registro ingresado
    $stmt = $dbh->prepare("SELECT id_cotizacion FROM tabla_cotizaciones WHERE id_usuario_publicacion='$id_usuario_publicacion' AND 
      id_usuario_cotizacion='$id_usuario_original' AND id_servicio='$id_servicio' AND tipo_servicio='$tipo_servicio' AND fecha_cotizacion='$fecha' AND
      fecha_desde='$fecha_desde' AND fecha_hasta='$fecha_hasta' AND total='$total'");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()) {
      $arrayIdCotizacion = $row;
    }
    $id_cotizacion = $arrayIdCotizacion['id_cotizacion'];

    //mandaremos un correo al usuario para cambiar el estado del usuario de pendiente a desbloqueado

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("rentfacilempresa@gmail.com", "Rent Facil");
    $email->setSubject("Cotización Maquinaria " . $titulo_maquinaria);
    $email->addTo($correoUsuario, $nombreUsuario);
    $email->addContent(
      "text/html",
      "
             <strong>Cotización Maquinaria " . $titulo_maquinaria . ".</strong>
             <p><strong>Descripción: </strong></p>
             <p>" . $descripcion_maquinaria . "</p>
             <p><strong>Bencina: </strong></p>
             <p>" . $bencina . "</p>
             <p><strong>Fecha Desde: </strong></p>
             <p>" . $fecha_desde . "</p>
             <p><strong>Fecha Hasta: </strong></p>
             <p>" . $fecha_hasta . "</p>
             <p><strong>Dirección: </strong></p>
             <p>" . $ubicacionFinal . " / " . $ubicacion_maquinaria . "</p>
             <p><strong>Monto Total: </strong></p>
             <p>$" . $total . "</p>
             <p><strong>Fecha Cotización: </strong></p>
             <p>" . $fecha . "</p>
             <p><strong>N°COTIZACIÓN:</strong></p>
             <p>" . $id_cotizacion . "</p>
             <a class='btn btn-success btn-lg' href='http://localhost/ProyectoInacap/RentFacil/contratos/preContrato.php?id_cotizacion=" . $id_cotizacion . "' role='button'>Contratar</a>"
    );
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
      $response = $sendgrid->send($email);
      // print $response->statusCode() . "\n";
      // print_r($response->headers());
      // print $response->body() . "\n";
    } catch (Exception $e) {
      // echo 'Caught exception: ' . $e->getMessage() . "\n";
    }
    $mensaje = 'enviado';
    echo '
            <script>
                    window.location="../Servicios/Maquinaria/publicacionMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
  } else {
    $mensaje = 'error_enviar';
    echo '
            <script>
                    window.location="../Servicios/Maquinaria/publicacionMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
  }

  ?>

</body>

</html>