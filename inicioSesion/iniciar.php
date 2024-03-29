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
            $tipo = $row['tipo'];
        }
        if ($estado == 2) {
            if($tipo == 2){
                $id_usuario_encriptado = $encriptar($id_usuario);
                echo '<script>window.location="../inicioHome/inicioAdmin.php?id_usuario=' . $id_usuario_encriptado . '"</script>';
            }else{
                $id_usuario_encriptado = $encriptar($id_usuario);
                echo '<script>window.location="../inicioHome/inicio.php?id_usuario=' . $id_usuario_encriptado . '"</script>';
            }
           
        } else {
            if ($estado == 1) {
                $mensaje = "sin_verificar";
            } else {
                $mensaje = "bloqueado";
            }
            echo '
                <script>
                        window.location="../inicioSesion/iniciarSesion.php?mensaje=' . $mensaje . '";
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
                            window.location="../inicioSesion/iniciarSesion.php?mensaje=' . $mensaje . '";
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
                            window.location="../inicioSesion/iniciarSesion.php?mensaje=' . $mensaje . '";
                    </script>';
            }
        } else {
            $mensaje = "no_registrado";
            echo '
                <script>
                        window.location="../inicioSesion/iniciarSesion.php?mensaje=' . $mensaje . '";
                </script>';
        }
    }




    /*
         if ($resultado->rowCount() == 1 && $resultado['estado'] == 2) {
           

        } else {
            
        }
        
    }
*/
}
?>