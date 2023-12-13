<style>
    <?php include("../CSS/iniciarSesion.css"); ?><?php include("../Header-Footer/header10.php"); ?>
</style>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<?php
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}
if (isset($_GET['id_cotizacion'])) {
    $id_cotizacion = $_GET['id_cotizacion'];
} else {
    $id_cotizacion = '';
}
?>
<html>

<script>
    // script para mostrar mensaje si el usuario a sido registrado correctamente
    let mensaje = "<?php echo $mensaje; ?>";
    if (mensaje == "ok") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">El usuario ha sido registrado con éxito.</p>
        //         `,
        // });
        alert("El usuario ha sido registrado con éxito.")
    }

    //script segun estado del usuario 1:sin verificar,3:usuario bloqueado
    if (mensaje == "sin_verificar") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">Usuario sin Verificar, porfavor revise correo de confirmación.</p>
        //         `,
        // });
        alert("Usuario sin Verificar, porfavor revise correo de confirmación.")
    }
    if (mensaje == "bloqueado") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">Usuario Bloqueado. Contactar con Administrador.</p>
        //         `,
        // });
        alert("Usuario Bloqueado. Contactar con Administrador.")
    }

    //script cuando el correo y la contrasena no coinciden
    if (mensaje == "no_coincide") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">Usuario y/o Contraseña no coinciden.Vuelve a intentarlo.</p>
        //         `,
        // });
        alert("Usuario y/o Contraseña no coinciden.Vuelve a intentarlo.")
    }
    //script cuando un usuario intenta iniciar con una cuenta no registrada
    if (mensaje == "no_registrado") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">El correo ingresado NO se encuentra registrado.</p>
        //         `,
        // });
        alert("El correo ingresado NO se encuentra registrado.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "validado") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">Su cuenta ha sido Validada con éxito.</p>
        //         `,
        // });
        alert("Su cuenta ha sido Validada con éxito.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "noValidado") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">Error al validar la Cuenta.</p>
        //         `,
        // });
        alert("Error al validar la Cuenta.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "cambioContrasena") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">La contraseña se actualizó con éxito.</p>
        //         `,
        // });
        alert("La contraseña se actualizó con éxito.")
    }
    //script cuando un usuario ha sido desbloqueado
    if (mensaje == "cuenta_desbloqueada") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">Cuenta Desbloqueada.</p>
        //         `,
        // });
        alert("Cuenta Desbloqueada.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "no_desbloquea") {
        // Swal.fire({
        //     html: `
        //         <p style="text-align:justify;">Error al desbloquear la Cuenta. Porfavor vuelve a Intentarlo.</p>
        //         `,
        // });
        alert("Error al desbloquear la Cuenta. Porfavor vuelve a Intentarlo.")
    }
</script>

<body>
    <div class="form">
        <form action="iniciarCotizacionAContrato.php" method="POST">
            <input class="input" type="hidden" name="id_cotizacion" value="<?php echo $id_cotizacion; ?>">
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
    </div>
</body>

</html>