<style>
    <?php include("../CSS/desbloquearCuentaFormulario.css"); ?><?php include("../Header-Footer/header3.php"); ?>
</style>

<?php
require_once "recaptchalib.php";
?>

<html>

<body>
    <div class="form">
        <form action="mandarCorreoRecuperarCuenta.php" method="POST">
            <div class="fs-2 txt"><i class="fa-solid fa-user fa-beat-fade"></i> DESBLOQUEAR CUENTA</div>
            <div class="form-group col-sm-3 mt-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <label for="email" class="visually-hidden">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa Email" required>
                </div>
                <small>(Si el email existe, recibirás un correo para poder cambiar tu contraseña)</small>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Enviar Correo</button>
            </div>
        </form>
        <div class="mt-4">
            <div><a href="formularioRecuperarContrasena.php" class="link-light">Olvidé mi contraseña</a></div>
            <div><a href="../registro/registrarUsuario.php" class="link-light">¿No tienes cuenta? Regístrate</a></div>
        </div>
    </div>
</body>

</html>