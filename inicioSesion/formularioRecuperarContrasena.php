<style>
    <?php include("../CSS/recuperarContrasenaFormulario.css"); ?>
</style>
<?php
include("../Header-Footer/header3.php");
?>
<html>

<body class="body">
    <div class="fondoformulario">
        <div class="fs-1 margen titulo ">RECUPERAR CONTRASEÑA</div>
        <form action="mandarCorreoRecuperarContrasena.php" method="POST">
            <div class="form-group col-sm-4 margen">
                <label for="email">Email</label>
                <input type="email" class="form-control input2" id="email" name="email" placeholder="Ingresa Email" Required>
                <small>(Si el email existe, recibirás un correo para poder cambiar tu contraseña)</small>
            </div>
            <div><button type="submit" class="btn btn-success boton">Enviar Correo</button></div>
        </form>
    </div>
</body>

</html>