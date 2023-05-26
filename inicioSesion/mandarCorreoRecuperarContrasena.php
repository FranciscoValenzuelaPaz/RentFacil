<?php
ini_set("display_errors",1);
ini_set('default_charset','utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");
require_once '../SendMail/config.php';
require '../SendMail/vendor/autoload.php'; 

if(isset($_POST['email'])){
    $email = $_POST['email'];
}else{
    $email='';
}

//comprobar si el correo existe en la base de datos 
$sql = "SELECT * FROM tabla_usuario WHERE email='$email'";
$resultado = $dbh->query($sql);
if ($resultado->rowCount() > 0) {
    $usuarios = $resultado->fetchAll(PDO::FETCH_OBJ);
    foreach ($usuarios as $usuario){
        $nombre = $usuario->nombre;
        $apellido = $usuario->apellido;
    }
     $nombreCompleto = $nombre." ".$apellido;
     $link = "http://localhost/ProyectoInacap/RentFacil/recuperarContrasena/recuperarContrasenaFormulario.php?email=".$email;
     $email = new \SendGrid\Mail\Mail(); 
     $email->setFrom("rentfacilempresa@gmail.com", "Rent Facil");
     $email->setSubject("Recuperar Contraseña de Usuario ".$nombreCompleto);
     $email->addTo("francisco.val920@gmail.com", $nombreCompleto);
     $email->addContent(
         "text/html", "<strong>Para poder recuperar tu contraseña, ingresa al siguiente Link</strong>
                    <br>
                     <a href='".$link."' style='color:#198754;'>Valida tu Cuenta de Usuario</a>"
     );
     $sendgrid = new \SendGrid(SENDGRID_API_KEY);
     try {
         $response = $sendgrid->send($email);
        //  print $response->statusCode() . "\n";
        //  print_r($response->headers());
        //  print $response->body() . "\n";
     } catch (Exception $e) {
         echo 'Caught exception: '. $e->getMessage() ."\n";
     }
}
 echo '
     <script>
          window.location="../inicioSesion/iniciarSesion.php";
     </script>';
?>