<?php
// FUNCION PARA AGREGAR CAPTCHA AL FORMULARIO, FALTA DOMINIO
//require_once "recaptchalib.php";   
$secret = "6LfXVEImAAAAAHeRqiDeu3F79M6ntIeZymTmN8zY";
$response = null;
// // Verificamos la clave secreta
// $reCaptcha = new ReCaptcha($secret);
// if ($_POST["g-recaptcha-response"]) {
//     $response = $reCaptcha->verifyResponse(
//     $_SERVER["REMOTE_ADDR"],
//     $_POST["g-recaptcha-response"]
//     );
//  }

// if ($response != null && $response->success) {
//    // Añade aquí el código que desees en el caso de que la validación sea correcta
//    echo "hola";
//  } else {
//    // Añade aquí el código que desees en el caso de que la validación no sea correcta o muestra
//    echo "chao";
//  }
?>
<?php
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");
require_once '../SendMail/config.php';
require '../SendMail/vendor/autoload.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = '';
}

//comprobar si el correo existe en la base de datos 
$sql = "SELECT * FROM tabla_usuario WHERE email='$email'";
$resultado = $dbh->query($sql);
if ($resultado->rowCount() > 0) {
    $usuarios = $resultado->fetchAll(PDO::FETCH_OBJ);
    foreach ($usuarios as $usuario) {
        $nombre = $usuario->nombre;
        $apellido = $usuario->apellido;
    }
    $nombreCompleto = $nombre . " " . $apellido;
    $link = "http://localhost/ProyectoInacap/RentFacil/recuperarContrasena/recuperarCuenta.php?email=" . $email;
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("rentfacilempresa@gmail.com", "Rent Facil");
    $email->setSubject("Recuperar Cuenta de Usuario " . $nombreCompleto);
    $email->addTo("francisco.val920@gmail.com", $nombreCompleto);
    $email->addContent(
        "text/html",
        "<strong>Para poder recuperar tu Cuenta, ingresa al siguiente Link</strong>
                    <br>
                     <a href='" . $link . "' style='color:#198754;'>Recupera tu Cuenta de Usuario</a>"
    );
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
        $response = $sendgrid->send($email);
        //  print $response->statusCode() . "\n";
        //  print_r($response->headers());
        //  print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . "\n";
    }
}
echo '
     <script>
          window.location="../inicioSesion/iniciarSesion.php";
     </script>';
?>