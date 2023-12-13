<style>
    <?php include("../CSS/iniciarSesion.css"); ?><?php include("../Header-Footer/header3.php"); ?>
</style>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<body>
    <div class="form">
        <form action="iniciar.php" method="POST">
            <div class="fs-2 txt"><i class="fa-solid fa-arrow-right-to-bracket fa-beat-fade"></i> INICIAR SESIÓN</div>
           
            <div class="form-group col-sm-3 mt-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <label for="email" class="visually-hidden">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa Email" required>
                </div>
            </div>

            <div class="form-group col-sm-3 mt-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                    <label for="contrasena" class="visually-hidden">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa Contraseña" required>
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Iniciar Sesión</button>
            </div>

        </form>

        <div class="mt-4">
            <div><a href="formularioRecuperarContrasena.php" class="link-light">Olvidé mi contraseña</a></div>
            <div><a href="../registro/registrarUsuario.php" class="link-light">¿No tienes cuenta? Regístrate</a></div>
            <div><a href="../inicioSesion/formularioDesbloquearCuenta.php" class="link-light">Desbloquear Cuenta</a></div>
        </div>
    </div>
</body>

</html>