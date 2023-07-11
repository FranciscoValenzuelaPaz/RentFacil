<?php
include("../Header-Footer/header7.php");
require_once '../SendMail/config.php';
require '../SendMail/vendor/autoload.php';

$arrayBencina = array("Con Bencina","Sin Bencina");

$id_usuario = $_POST['id_usuario'];
$id_usuario_publicacion = $_POST['id_usuario_publicacion'];
$id_servicio = $_POST['id_servicio'];
// $monto = $_POST['monto'];
$tipo_servicio = $_POST['tipo_servicio'];
$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];
$fecha = date("Y-m-d");

if($tipo_servicio == 1){
  //consulta para traer la información de la maquinaria seleccionada
  $arrayInfoMaquinaria = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias as M JOIN tabla_usuario as U ON M.id_usuario = U.id_usuario WHERE M.id_maquinaria='$id_servicio'");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayInfoMaquinaria[] = $row;
  }
  $titulo= $arrayInfoMaquinaria[0]['titulo'];
  $titulocorreo = 'Maquinaria';
  $descripcion = $arrayInfoMaquinaria[0]['descripcion'];
  $bencina = $arrayInfoMaquinaria[0]['bencina'];
  $bencina = $arrayBencina[$bencina];
  $ubicacionPublicacion = $arrayInfoMaquinaria[0]['ubicacion'];
  $monto = $arrayInfoMaquinaria[0]['montoArriendo'];
  $correo_usuario_publicacion = $arrayInfoMaquinaria[0]['email'];
  $nombre_usuario_publicacion = $arrayInfoMaquinaria[0]['nombre']." ".$arrayInfoMaquinaria[0]['apellido'];
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

}else{
  //consulta para traer la información del estacionamiento seleccionada
  $arrayInfoEstacionamiento = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_estacionamientos as E JOIN tabla_usuario as U ON E.id_usuario=U.id_usuario  WHERE E.id_estacionamiento='$id_servicio'");
  // Especificamos el fetch mode antes de llamar a fetch()
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $stmt->execute();
  // Mostramos los resultados
  while ($row = $stmt->fetch()) {
    $arrayInfoEstacionamiento[] = $row;
  }
  $titulo = $arrayInfoEstacionamiento[0]['titulo'];
  $titulocorreo = 'Estacionamiento';
  $descripcion = $arrayInfoEstacionamiento[0]['descripcion'];
  $ubicacionPublicacion = $arrayInfoEstacionamiento[0]['ubicacion'];
  $montoxdia = $arrayInfoEstacionamiento[0]['montoArriendo'];
  $montoxhora = $arrayInfoEstacionamiento[0]['montoArriendo2'];
  $correo_usuario_publicacion = $arrayInfoEstacionamiento[0]['email'];
  $nombre_usuario_publicacion = $arrayInfoEstacionamiento[0]['nombre']." ".$arrayInfoMaquinaria[0]['apellido'];

  //array con informacion de las direcciones del usuario
  $arrayUbicacion = array();
  $stmt = $dbh->prepare("SELECT * FROM tabla_estacionamientos as M JOIN tabla_comunas as COMUNA ON M.id_comuna = COMUNA.id_comuna JOIN tabla_ciudades AS 
  CIUDAD ON COMUNA.id_ciudad = CIUDAD.id_ciudad JOIN tabla_regiones AS REGION ON CIUDAD.id_region=REGION.id_region WHERE M.id_estacionamiento='$id_servicio'");
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
  
}




//consulta para traer la información del Usuario Cotizador seleccionada
$arrayUsuario = array();
$stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE id_usuario='$id_usuario'");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
while ($row = $stmt->fetch()) {
  $arrayUsuario[] = $row;
}

$nombreUsuario = $arrayUsuario[0]['nombre']." ".$arrayUsuario[0]['apellido'];

$fecha_desde = str_replace("T"," ",$fecha_desde);
$fecha_hasta = str_replace("T"," ",$fecha_hasta);
// echo $fecha_desde."<br>";
// echo $fecha_hasta."<br>";


$fecha_desde_truncada = substr($fecha_desde,0,10);
$fecha_hasta_truncada = substr($fecha_hasta,0,10);

// echo $fecha_desde_truncada."<br>";
// echo $fecha_hasta_truncada."<br>";


$fecha1= new DateTime($fecha_desde);
$fecha2= new DateTime($fecha_hasta);

$diff = $fecha1->diff($fecha2);

if($fecha_desde_truncada == $fecha_hasta_truncada){
  $hora_diferencia = $diff->format('%H') ;
  $minutos_diferencia = $diff->format('%i') ;
  $total = $montoxhora * $hora_diferencia;

  //trabajamos el precio de los minutos
  $precioxminuto = ($montoxhora / 60 )*$minutos_diferencia;
  $total = $total + $precioxminuto;

}else{
  $diferencia = $diff->days;   //este numero se multiplica por el monto para calcular el total
  echo  $diferencia;
  $total = $montoxdia * $diferencia;
}


$estado = 1;



//generamos consulta para actualizar los datos en la base de datos
 $sql = "INSERT INTO tabla_contratos (id_usuario_publicacion, id_usuario_contratante ,id_servicio , tipo_servicio,
  fecha_contrato, fecha_desde, fecha_hasta, total, estado) VALUES
 ( '$id_usuario_publicacion ', '$id_usuario', '$id_servicio', '$tipo_servicio', '$fecha', '$fecha_desde', '$fecha_hasta', '$total', '$estado')";

     if ($dbh->exec($sql)) {
//         //mandaremos un correo al usuario para cambiar el estado del usuario de pendiente a desbloqueado

         $email = new \SendGrid\Mail\Mail();
         $email->setFrom("rentfacilempresa@gmail.com", "Rent Facil");
         $email->setSubject("Cotización  ".$titulo);
         $email->addTo("francisco.val920@gmail.com", $nombreUsuario);
         $email->addTo($correo_usuario_publicacion, $nombre_usuario_publicacion); //traer nombre de usuario que publicó
         if($titulocorreo =='Maquinaria'){
          $email->addContent(
            "text/html",
            "
             <strong>Cotización ".$titulocorreo." ".$titulo."</strong>
             <p><strong>Descripción: </strong></p>
             <p>".$descripcion."</p>
             <p><strong>Bencina: </strong></p>
             <p>".$bencina."</p>
             <p><strong>Fecha Desde: </strong></p>
             <p>".$fecha_desde."</p>
             <p><strong>Fecha Hasta: </strong></p>
             <p>".$fecha_hasta."</p>
             <p><strong>Dirección: </strong></p>
             <p>".$ubicacionFinal." / ".$ubicacionPublicacion."</p>
             <p><strong>Monto Total: </strong></p>
             <p>$".$total."</p>
             <p><strong>Fecha Contrato: </strong></p>
             <p>".$fecha."</p>
             <p><strong>Estado: </strong></p>
             <p>Pago Pendiente</p>"
        );
        }else{
          $email->addContent(
            "text/html",
            "
             <strong>Cotización ".$titulocorreo." ".$titulo."</strong>
             <p><strong>Descripción: </strong></p>
             <p>".$descripcion."</p>
             <p><strong>Fecha Desde: </strong></p>
             <p>".$fecha_desde."</p>
             <p><strong>Fecha Hasta: </strong></p>
             <p>".$fecha_hasta."</p>
             <p><strong>Dirección: </strong></p>
             <p>".$ubicacionFinal." / ".$ubicacionPublicacion."</p>
             <p><strong>Monto Total: </strong></p>
             <p>$".$total."</p>
             <p><strong>Fecha Contrato: </strong></p>
             <p>".$fecha."</p>
             <p><strong>Estado: </strong></p>
             <p>Pago Pendiente</p>"
        );
        }
         
         $sendgrid = new \SendGrid(SENDGRID_API_KEY);
         try {
             $response = $sendgrid->send($email);
             // print $response->statusCode() . "\n";
//             // print_r($response->headers());
//             // print $response->body() . "\n";
         } catch (Exception $e) {
             // echo 'Caught exception: ' . $e->getMessage() . "\n";
         }

         $actualizarEstado = 2;

         $mensaje = 'enviado';
         if($titulocorreo == "Maquinaria"){
           //generamos consulta para actualizar los datos en la base de datos
          $query = $dbh->prepare("UPDATE tabla_maquinarias SET estado = ? WHERE id_maquinaria = ?;");
          $resultado = $query->execute([$actualizarEstado, $id_servicio]); # Pasar en el mismo orden de los ?

          echo '
             <script>
                     window.location="../Servicios/Maquinaria/publicacionMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
         }else{
            
           //generamos consulta para actualizar los datos en la base de datos
           $query = $dbh->prepare("UPDATE tabla_estacionamientos SET estado = ? WHERE id_estacionamiento = ?;");
           $resultado = $query->execute([$actualizarEstado ,$id_servicio]); # Pasar en el mismo orden de los ? 
          echo '
             <script>
                     window.location="../Servicios/Estacionamiento/publicacionEstacionamiento.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
         }
         
     } else {
         $mensaje = 'error_enviar';
         if($titulocorreo == "Maquinaria"){
          echo '
             <script>
                     window.location="../Servicios/Maquinaria/publicacionMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
         }else{
          echo '
             <script>
                     window.location="../Servicios/Estacionamiento/publicacionEstacionamiento.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
         
         }
     }

?>