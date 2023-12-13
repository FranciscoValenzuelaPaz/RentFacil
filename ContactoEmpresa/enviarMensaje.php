<style>
    <?php include("../CSS/formularioCotizacion.css"); ?>
</style>

<?php
include("../Header-Footer/header7.php");
require_once '../SendMail/config.php';
require '../SendMail/vendor/autoload.php';

$id_usuario = $_POST['id_usuario'];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$mensaje = $_POST["mensaje"];
$asunto = $_POST["asunto"];
$mensaje_respuesta = '';
$correo_empresa = "rentfacilcontacto@gmail.com";
$nombre_empresa = "RentFacil Contacto";

if ($id_usuario != "") {
    //mandaremos un correo a la empresa 
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("rentfacilempresa@gmail.com", "Rent Facil");
    $email->setSubject($asunto);
    $email->addTo($correo_empresa, $nombre);
    $email->addContent(
        "text/html",
        "
             <strong>Contacto con RentFacil</strong>
             <p><strong>Nombre: </strong></p>
             <p>" . $nombre . "</p>
             <p><strong>Teléfono: </strong></p>
             <p>" . $telefono . "</p>
             <p><strong>Correo: </strong></p>
             <p>" . $correo . "</p>
             <p><strong>Asunto: </strong></p>
             <p>" . $asunto . "</p>
             <p><strong>Mensaje: </strong></p>
             <p>" . $mensaje . "</p>"
    );
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    try {
        $response = $sendgrid->send($email);

        $mensaje_respuesta = 'enviado';
        // print $response->statusCode() . "\n";
        // print_r($response->headers());
        // print $response->body() . "\n";
    } catch (Exception $e) {
        $mensaje_respuesta = 'error_enviar';
        // echo 'Caught exception: ' . $e->getMessage() . "\n";
    }

    echo '
            <script>
                    window.location="formularioContactarEmpresa.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje_respuesta . '";
            </script>';
}
?>