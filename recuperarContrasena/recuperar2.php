<?php
include("../Header-Footer/header.php");
include("../encriptarContrasena/encriptarClave.php");

//capturar datos del formulario
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$contrasena = $encriptar($contrasena);
$mensaje = '';
//consulta para cambiar contrasena en la base de datos 
$sql = "UPDATE tabla_usuario SET contrasena = '$contrasena', intentos=1, estado=2 WHERE email='$email'";
if ($dbh->exec($sql)) {
    $mensaje = "cuenta_desbloqueada";
} else {
    $mensaje = "no_desbloquea";
}
echo '
    <script>
        window.location="../inicioSesion/iniciarSesion.php?mensaje=' . $mensaje . '";
    </script>';
