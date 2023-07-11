<!DOCTYPE html>
<html lang="en">
<?php
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Sweet Alert Script -->
    <script src="../js/sweetalert.min.js"></script>
    <title></title>
</head>
<?php

//var_dump($_POST);
//capturo los datos del formulario
$id_usuario = $_GET['id_usuario'];
$id_direccion = $_GET['id_direccion'];
$fecha = date("Y-m-d H:i:s");
$respuesta = TRUE;
$mensaje = '';

//var_dump($_POST);
//generamos consulta para eliminar los datos de la base de datos
$query = $dbh->prepare("UPDATE tabla_direcciones SET eliminado = ?, fecha_eliminacion = ?, usuario_eliminacion = ? WHERE id_direccion = ?;");
    $resultado = $query->execute([$respuesta,$fecha, $id_usuario ,$id_direccion]); # Pasar en el mismo orden de los ?
    if ($resultado === TRUE) {
        $mensaje = "eliminado";
        echo '
            <script>
                window.location="../DireccionesAdmin/crudDirecciones.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
    } else {
        $mensaje = "error_eliminar";
        echo '
            <script>
                window.location="../DireccionesAdmin/crudDirecciones.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
    }
//echo $mensaje;



?>