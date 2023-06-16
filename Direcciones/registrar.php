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

if (isset($_POST['btnIngresarDireccion'])) {
    //capturo los datos del formulario
    $email = $_POST['email'];
    $id_region = $_POST['id_region'];
    $id_ciudad = $_POST['id_ciudad'];
    $id_comuna = $_POST['id_comuna'];
    $direccion = $_POST['direccion'];
    $tipo_direccion = $_POST['tipo_direccion'];

    $mensaje = '';


    //crearemos una consulta para traer la cantidad de direcciones que posee el usuario
    //NO DEBE TENER MÁS DE 5 DIRECCIONES
    $arrayCantidadDirecciones = array();
    $stmt = $dbh->prepare("SELECT * FROM tabla_direcciones WHERE correo='$email'");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    //$stmt->execute();


    // var_dump($stmt->execute());

    // si esque existe un registro de direccion, consultaremos la cantidad de direcciones registrada
    if ($stmt->execute() == true) {
        while ($row = $stmt->fetch()) {
            $arrayCantidadDirecciones[] = $row;
        }
        $cantidad = count($arrayCantidadDirecciones);
        if ($cantidad == 5) {
            $mensaje = 'max_direcciones';
        }
    }





    //var_dump($_POST);

    //generamos consulta para actualizar los datos en la base de datos
    $sql = "INSERT INTO tabla_direcciones (correo, id_region ,id_ciudad , id_comuna, direccion, tipo_direccion) VALUES
    ( '$email ', '$id_region', '$id_ciudad', '$id_comuna', '$direccion', '$tipo_direccion')";

    if ($mensaje != "max_direcciones") {
        if ($dbh->exec($sql)) {
            $mensaje = 'registrado';
            echo '
                <script>
                        window.location="../Direcciones/crudDirecciones.php?email=' . $email . '&mensaje=' . $mensaje . '";
                </script>';
        } else {
            $mensaje = 'error_registrar';
            echo '
                <script>
                        window.location="../Direcciones/crudDirecciones.php?email=' . $email . '&mensaje=' . $mensaje . '";
                </script>';
        }
    } else {
        echo '
                <script>
                        window.location="../Direcciones/crudDirecciones.php?email=' . $email . '&mensaje=' . $mensaje . '";
                </script>';
    }
}

?>