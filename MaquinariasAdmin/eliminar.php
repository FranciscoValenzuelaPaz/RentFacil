<?php
 include("../Header-Footer/header4.php");

 if(isset($_GET['id_usuario']) && isset($_GET['id_maquinaria']) && isset($_GET['link'])){
    $id_usuario = $_GET['id_usuario'];
    $id_maquinaria = $_GET['id_maquinaria'];
    $link_foto = $_GET['link'];
    $respuesta = TRUE;
    $fecha = date("Y-m-d H:i:s");
 }else{
    $id_usuario = '';
    $id_maquinaria = '';
    $link_foto = '';
 }

 $mensaje = '';

 //var_dump($_GET);

 $query = $dbh->prepare("UPDATE tabla_maquinarias SET eliminado = ?,fecha_eliminacion = ?,usuario_eliminacion = ? WHERE id_maquinaria = ?");
$resultado = $query->execute([$respuesta,$fecha,$id_usuario, $id_maquinaria]); # Pasar en el mismo orden de los ?
if ($resultado === TRUE) {
$mensaje = "eliminado";
echo '
         <script>
                 window.location="../MaquinariasAdmin/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
         </script>';
} else {
$mensaje = "error_eliminar";
echo '
         <script>
                 window.location="../MaquinariasAdmin/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
         </script>';
}
