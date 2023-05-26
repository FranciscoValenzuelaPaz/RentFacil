<?php
ini_set("display_errors",1);
ini_set('default_charset','utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");
if(isset($_GET['correo'])){
    $correo = $_GET['correo'];
}
else{
    $correo = '';
}

//creamos consulta para cambiar el estado de la cuenta del Usuario a 2

$sql = "UPDATE tabla_usuario SET estado = 2 WHERE email='$correo'";
if ($dbh->exec($sql)) {
    $mensaje = "validado";
    echo '
    <script>
         window.location="../inicioSesion/iniciarSesion.php?mensaje='.$mensaje.'";
    </script>';
}else{
    $mensaje = "noValidado";
}

?>


