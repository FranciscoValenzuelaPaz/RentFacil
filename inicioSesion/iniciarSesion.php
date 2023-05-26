<?php
include("../Header-Footer/header3.php");
if(isset($_GET['mensaje'])){
    $mensaje = $_GET['mensaje'];
}else{
    $mensaje = '';
}
?>
<script>
    // script para mostrar mensaje si el usuario a sido registrado correctamente
    let mensaje = "<?php echo $mensaje;?>";
    if(mensaje == "ok"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">El usuario ha sido registrado con éxito.</p>
                    `,
        });
    }

    //script segun estado del usuario 1:sin verificar,3:usuario bloqueado
    if(mensaje == "sin_verificar"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">Usuario sin Verificar, porfavor revise correo de confirmación.</p>
                    `,
        });
    }
    if(mensaje == "bloqueado"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">Usuario Bloqueado. Contactar con Administrador.</p>
                    `,
        });
    }

    //script cuando el correo y la contrasena no coinciden
    if(mensaje == "no_coincide"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">Usuario y/o Contraseña no coinciden.Vuelve a intentarlo.</p>
                    `,
        });
    }
    //script cuando un usuario intenta iniciar con una cuenta no registrada
    if(mensaje == "no_registrado"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">El correo ingresado NO se encuentra registrado.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido validado a traves de email
    if(mensaje == "validado"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">Su cuenta ha sido Validada con éxito.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido validado a traves de email
    if(mensaje == "noValidado"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">Error al validar la Cuenta.</p>
                    `,
        });
    }
    //script cuando un usuario ha sido validado a traves de email
    if(mensaje == "cambioContrasena"){
        Swal.fire({
                    html: `
                    <p style="text-align:justify;">La contraseña se actualizó con éxito.</p>
                    `,
        });
    }
</script>

<body>
    <style>
        .formulario{
            width: 50% !important;
            margin-left: 25% !important;
        }
    </style>
    <br>
    <div class="fs-2">Iniciar Sesión</div>
    <br><br>
    <div class="">
    <form action="iniciar.php" method="POST">
        <div class="form-group">
        <label for="email">Email</label>
        <br>
        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa Email" Required>
        </div>
        <br>
        <div class="form-group">
        <label for="contrasena">Contraseña</label>
        <br>
        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa Contraseña" Required>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Iniciar Sesión</button><br><br>
    </form>
    
    <a href="formularioRecuperarContrasena.php" class="link-success" >Olvidé mi contraseña</a>
    <br><br>
    <a href="../registro/registrarUsuario.php" class="link-success" >¿No Tienes Cuenta? Registrate.</a>
    </div>
</body>

</html>