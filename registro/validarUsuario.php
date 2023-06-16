<!-- API KEY para correos: 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 -->

<?php
require_once '../SendMail/config.php';
require '../SendMail/vendor/autoload.php';
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");
include("../encriptarContrasena/encriptarClave.php");

$errorEncontrado = '';
$mensaje = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $rut = trim($_POST["rut"]);
    $telefono = trim($_POST["telefono"]);
    $email = trim($_POST["email"]);
    $contrasena = trim($_POST["contrasena"]);
    $confirmarContrasena = trim($_POST["confirmarContrasena"]);
    $terminos = trim($_POST["terminos"]);
    if (
        empty($nombre) || empty($apellido) || empty($rut) || empty($telefono) ||
        empty($email) || empty($contrasena) || empty($confirmarContrasena) || empty($terminos)
    ) {
        $mensaje = "vacio";
        echo '
                <script>
                        window.location="registrarUsuario.php?mensaje=' . $mensaje . '";
                </script>';
    } else {

        $sql = "SELECT * FROM tabla_usuario WHERE rut='$rut' OR email='$email'";
        $resultado = $dbh->query($sql);
        if ($resultado->rowCount() > 0) {
            $mensaje = "existe";
            echo '
                <script>
                        window.location="registrarUsuario.php?mensaje=' . $mensaje . '";
                </script>';
        } else {
            $contrasenaEncriptada = $encriptar($contrasena);
            $estado = 1;
            $sql = "INSERT INTO tabla_usuario (nombre, apellido ,rut , telefono, email, contrasena,estado) VALUES
                 ( '$nombre ', '$apellido', '$rut', '$telefono', '$email', '$contrasenaEncriptada','$estado')";


            if ($dbh->exec($sql)) {
                $mensaje = "ok";
                $nombreCompleto = $nombre . " " . $apellido;
                $link = "http://localhost/ProyectoInacap/RentFacil/registro/validarCuentaCorreo.php?correo=" . $email;

                //mandaremos un correo al usuario para cambiar el estado del usuario de pendiente a desbloqueado

                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("rentfacilempresa@gmail.com", "Rent Facil");
                $email->setSubject("Correo para Validar Usuario Rent Facil");
                $email->addTo("francisco.val920@gmail.com", $nombreCompleto);
                $email->addContent(
                    "text/html",
                    "
                     <strong>Por favor, clickea el link para validar tu Cuenta.</strong>
                     <br>
                     <a href='" . $link . "' style='color:#198754;'>Valida tu Cuenta de Usuario</a>"

                );

                $sendgrid = new \SendGrid(SENDGRID_API_KEY);
                try {
                    $response = $sendgrid->send($email);
                    // print $response->statusCode() . "\n";
                    // print_r($response->headers());
                    // print $response->body() . "\n";
                } catch (Exception $e) {
                    echo 'Caught exception: ' . $e->getMessage() . "\n";
                }

                echo '
                    <script>
                            window.location="../inicioSesion/iniciarSesion.php?mensaje=' . $mensaje . '";
                    </script>';
            } else {
                $mensaje = "error";
                echo '
                    <script>
                            window.location="registrarUsuario.php?mensaje=' . $mensaje . '";
                    </script>';
            }
        }
    }
}
