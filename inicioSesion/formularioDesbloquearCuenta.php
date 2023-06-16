<style>
    <?php include("../CSS/desbloquearCuentaFormulario.css"); ?>
</style>
<?php
require_once "recaptchalib.php";
include("../Header-Footer/header3.php");
?>

<html>

<body class="body">
    <div class="fondoformulario">
        <div class="fs-1 margen inicio">DESBLOQUEAR CUENTA</div>
        <form action="mandarCorreoRecuperarCuenta.php" method="POST">
            <div class="form-group col-sm-4 margen">
                <label for="email">Email</label>

                <input type="email" class="form-control input2" id="email" name="email" placeholder="Ingresa Email" Required>
                <small>(Si el email existe, recibirás un correo para poder cambiar tu contraseña)</small>
            </div>
            <!-- <div class="g-recaptcha" data-sitekey="6LfXVEImAAAAAPBi1G4TM7ozVTgxvAeQqCFHHisg"></div> -->
            <!-- br -->
            <div class="form-group margen fin ">
                <button type="submit" class="btn btn-success fin">Enviar Correo</button>
            </div>
        </form>
    </div>
</body>

</html>