<?php

include("../Header-Footer/header7.php");
include("../encriptarContrasena/encriptarClave.php");
require "vendor/autoload.php";

if (isset($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];
} else {
    $id_contrato = '';
}
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    $id_usuario_original = $desencriptar($id_usuario);
} else {
    $id_usuario = '';
    $id_usuario_original = '';
}

?>

<div class="jumbotron fondojumbotron">
        <div class="contenidoJumbotron">
            <h1 class="display-4">PAGO RECHAZADO</h1>
            <hr class="my-4">
            <a href="http://localhost/ProyectoInacap/RentFacil/PagoContrato/pagarContrato.php?id_usuario=<?php echo $id_usuario ?>&id_contrato=<?php echo $id_contrato ?>" class="btn btn-success">Volver a Pagar</a>
        </div>
    </div>

</html>
</body>

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      -->