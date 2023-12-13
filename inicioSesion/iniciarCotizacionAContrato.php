<?php
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");
include("../encriptarContrasena/encriptarClave.php");
$mensaje = '';
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_cotizacion = $_POST["id_cotizacion"];
    $email = trim($_POST["email"]);
    $contrasena = trim($_POST["contrasena"]);
    $id_usuario_encriptado = '';

    $contrasenaEncriptada = $encriptar($contrasena);
    // FETCH_ASSOC
    $stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE email='$email' AND contrasena='$contrasenaEncriptada'");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $estado = '';
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
            $estado = $row['estado'];
            $id_usuario = $row['id_usuario'];
        }
        if ($estado == 2) {

            $stmt = $dbh->prepare("SELECT * FROM tabla_cotizaciones WHERE id_cotizacion='$id_cotizacion'");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                $id_maquinaria = $row['id_servicio'];
                }
            }else{
                $id_maquinaria= '';
            }
            $id_usuario_encriptado = $encriptar($id_usuario);
            echo '<script>window.location="../contratos/formularioContrato.php?id_usuario=' . $id_usuario_encriptado . '&tipo_servicio=1&id_maquinaria='.$id_maquinaria.'"</script>'; 
        } else {
            if ($estado == 1) {
                $mensaje = "sin_verificar";
            } else {
                $mensaje = "bloqueado";
            }
            echo '
                <script>
                        window.location="../inicioSesion/iniciarSesionCotizacionAContrato.php?mensaje=' . $mensaje . '&id_cotizacion='.$id_cotizacion.'";
                </script>';
        }
    } else {
        //si la contraseña y el mail no coinciden con los registrados aumentamos los intentos 
        //consultamos por la cantidad de intentos registrados en ese correo 
        $stmt2 = $dbh->prepare("SELECT * FROM tabla_usuario WHERE email='$email'");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt2->execute();
        if ($stmt2->rowCount() > 0) {
            // consultamos por los intentos del correo ingresado
            $intentos = 0;
            while ($row = $stmt2->fetch()) {
                $intentos = $row['intentos'];
                $estado = $row['estado'];
            }
            if ($intentos == 3) {
                $mensaje = "bloqueado";
                if ($estado == 3) {
                } else {
                    $stmt3 = $dbh->prepare("UPDATE tabla_usuario SET estado=3 WHERE email='$email'");
                    // Especificamos el fetch mode antes de llamar a fetch()
                    $stmt3->setFetchMode(PDO::FETCH_ASSOC);
                    // Ejecutamos
                    $stmt3->execute();
                }
                echo '
                    <script>
                            window.location="../inicioSesion/iniciarSesionCotizacionAContrato.php?mensaje=' . $mensaje . '&id_cotizacion='.$id_cotizacion.'";
                    </script>';
            } else {
                $intentos = $intentos + 1;
                $stmt3 = $dbh->prepare("UPDATE tabla_usuario SET intentos='$intentos' WHERE email='$email'");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt3->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt3->execute();
                $mensaje = "no_coincide";
                echo '
                    <script>
                            window.location="../inicioSesion/iniciarSesionCotizacionAContrato.php?mensaje=' . $mensaje . '&id_cotizacion='.$id_cotizacion.'";
                    </script>';
            }
        } else {
            $mensaje = "no_registrado";
            echo '
                <script>
                        window.location="../inicioSesion/iniciarSesionCotizacionAContrato.php?mensaje=' . $mensaje . '&id_cotizacion='.$id_cotizacion.'";
                </script>';
        }
    }




}
?>