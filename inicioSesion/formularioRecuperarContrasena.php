<?php
include("../Header-Footer/header3.php");
?>
<body>
    <style>
        .formulario{
            width: 50% !important;
            margin-left: 25% !important;
        }
    </style>
    <br>
    <div class="fs-2 text-center">Recuperar Contraseña</div>
    <br><br>
    <div class="formulario">
    <form action="mandarCorreoRecuperarContrasena.php" method="POST">
        <div class="form-group">
        <label for="email">Email</label>
        <br>
        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa Email" Required>
        <small>(Si el email existe, recibirás un correo para poder cambiar tu contraseña)</small>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Enviar Correo</button><br><br>
    </form>
    </div>
</body>

</html>