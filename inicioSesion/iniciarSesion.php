<style>
    <?php include("../CSS/iniciarSesion.css"); ?>
</style>

<?php
include("../Header-Footer/header3.php");
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}
?>

<script>
    // script para mostrar mensaje si el usuario a sido registrado correctamente
    let mensaje = "<?php echo $mensaje; ?>";
    if (mensaje == "ok") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">El usuario ha sido registrado con éxito.</p>
                    `,
        });
    }

    //script segun estado del usuario 1:sin verificar,3:usuario bloqueado
    if (mensaje == "sin_verificar") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">Usuario sin Verificar, porfavor revise correo de confirmación.</p>
                    `,
        });
    }
    if (mensaje == "bloqueado") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">Usuario Bloqueado. Contactar con Administrador.</p>
                    `,
        });
    }

    //script cuando el correo y la contrasena no coinciden
    if (mensaje == "no_coincide") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">Usuario y/o Contraseña no coinciden.Vuelve a intentarlo.</p>
                    `,
        });
    }
    //script cuando un usuario intenta iniciar con una cuenta no registrada
    if (mensaje == "no_registrado") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">El correo ingresado NO se encuentra registrado.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "validado") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">Su cuenta ha sido Validada con éxito.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "noValidado") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">Error al validar la Cuenta.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "cambioContrasena") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">La contraseña se actualizó con éxito.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido desbloqueado
    if (mensaje == "cuenta_desbloqueada") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">Cuenta Desbloqueada.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "no_desbloquea") {
        Swal.fire({
            html: `
                    <p style="text-align:justify;">Error al desbloquear la Cuenta. Porfavor vuelve a Intentarlo.</p>
                    `,
        });
    }
</script>

<html>

<body class="body">
    <div class="fondoformulario">
        <form action="iniciar.php" method="POST">
            <div class="fs-1 margen inicio">INICIAR SESIÓN</div>
            <div class="form-group col-sm-4 margen">
                <label for="email">Email</label>
                <input type="email" class="form-control input2" id="email" name="email" placeholder="Ingresa Email" Required>
            </div>
            <div class="form-group col-sm-4 margen">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control input2" id="contrasena" name="contrasena" placeholder="Ingresa Contraseña" Required>
            </div>
            <div class="form-group margen">
                <button type="submit" class="btn btn-success">Iniciar Sesión</button>
            </div>
        </form>
        <div class="fin">
            <div><a href="formularioRecuperarContrasena.php" class="link-secondary">Olvidé mi contraseña</a></div>
            <div><a href="../registro/registrarUsuario.php" class="link-secondary">¿No Tienes Cuenta? Registrate.</a></div>
            <div><a href="../inicioSesion/formularioDesbloquearCuenta.php" class="link-secondary ">Desbloquear Cuenta</a></div>
        </div>
    </div>
</body>

</html>