<?php
 include("../Header-Footer/header4.php");

 if(isset($_GET['id_usuario']) && isset($_GET['id_estacionamiento']) && isset($_GET['link'])){
    $id_usuario = $_GET['id_usuario'];
    $id_estacionamiento = $_GET['id_estacionamiento'];
    $link_foto = $_GET['link'];
    $fecha = date("Y-m-d H:i:s");
    $respuesta = TRUE;
 }else{
    $id_usuario = '';
    $id_estacionamiento = '';
    $link_foto = '';
 }

 $mensaje = '';

 //var_dump($_GET);

  //generamos consulta para actualizar los datos en la base de datos
$query = $dbh->prepare("UPDATE tabla_estacionamientos SET eliminado=?,fecha_eliminacion = ?,usuario_eliminacion = ?   WHERE id_estacionamiento = ?;");
$resultado = $query->execute([$respuesta,$fecha,$id_usuario, $id_estacionamiento]); # Pasar en el mismo orden de los ?
if ($resultado === TRUE) {
$mensaje = "eliminado";
echo '
        <script>
           window.location="../EstacionamientosAdmin/crudEstacionamiento.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
        </script>';
} else {
$mensaje = "error_eliminar";
echo '
        <script>
           window.location="../EstacionamientosAdmin/crudEstacionamiento.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
        </script>';
}
