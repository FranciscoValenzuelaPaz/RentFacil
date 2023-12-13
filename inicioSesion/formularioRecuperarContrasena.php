<style>
    <?php include("../CSS/recuperarContrasenaFormulario.css"); ?><?php include("../Header-Footer/header3.php"); ?>
</style>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>



<body>
    <div class="form">
        <form action="mandarCorreoRecuperarContrasena.php" method="POST">
            <div class="fs-2 txt"><i class="fa-solid fa-key fa-beat-fade"></i> RECUPERAR CONTRASEÑA</div>
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
            <div><a href="../registro/registrarUsuario.php" class="link-light">¿No tienes cuenta? Regístrate</a></div>
            <div><a href="../inicioSesion/formularioDesbloquearCuenta.php" class="link-light">Desbloquear Cuenta</a></div>
        </div>
    </div>
</body>

</html>