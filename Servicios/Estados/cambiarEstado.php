<style>
  <?php include("../../CSS/publicacionEstacionamiento.css"); ?>
</style>
<?php
include("../../Header-Footer/header6.php");
include("../../encriptarContrasena/encriptarClave.php");
if (isset($_GET['id_usuario']) && isset($_GET['id_servicio']) && isset($_GET['tipo_servicio'])) {
    $id_usuario = $_GET['id_usuario'];
    $id_usuario_original = $desencriptar($id_usuario);
    $id_servicio = $_GET['id_servicio'];
    $tipo_servicio = $_GET['tipo_servicio'];
  } else {
    $id_usuario = '';
    $id_usuario_original = '';
    $id_servicio = '';
    $tipo_servicio = '';
  }



  #CAMBIO DE ESTADO
  if($tipo_servicio == 1) {
    $query = $dbh->prepare("UPDATE tabla_maquinarias SET estado = ? WHERE id_maquinaria = ?;");
    $resultado = $query->execute([1,$id_servicio]); # Pasar en el mismo orden de los ?
    if ($resultado === TRUE) {
        $mensaje = "editado_maquinaria";
        echo '
             <script>
                     window.location="../../Servicios/Estados/estadoServicios.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
    }else{
        $mensaje = "error_editado_maquinaria";
        echo '
             <script>
                     window.location="../../Servicios/Estados/estadoServicios.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
    }
  }else{
    $query = $dbh->prepare("UPDATE tabla_estacionamientos SET estado = ? WHERE id_estacionamiento = ?;");
    $resultado = $query->execute([1,$id_servicio]); # Pasar en el mismo orden de los ?
    if ($resultado === TRUE) {
        $mensaje = "editado_estacionamiento";
        echo '
             <script>
                     window.location="../../Servicios/Estados/estadoServicios.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
    }else{
        $mensaje = "error_editado_estacionamiento";
        echo '
             <script>
                     window.location="../../Servicios/Estados/estadoServicios.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
    }
  }


?>

