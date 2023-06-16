<style>
    <?php include("../CSS/recuperarCuentaFormulario.css"); ?>
</style>

<?php
include("../Header-Footer/header3.php");
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    $email = '';
}
?>

<body class="body">
    <div class="fondoformulario margen">
        <div class="fs-2">RECUPERAR CUENTA</div>
        <form action="recuperar2.php" method="POST">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <div class="form-group input">
                <label for="contrasena">Nueva Contraseña</label>
                <input type="password" class="form-control input2" id="contrasena" name="contrasena" onchange="validar_contrasena(this.value)" placeholder="Ingresa Contraseña" Required>
            </div>
            <script>
                function validar_contrasena(contrasena) {
                    if (contrasena.length == 0) {} else {
                        if (contrasena.length < 8) {
                            alert("La contraseña debe tener mínimo 8 caracteres. Vuelve a intentarlo.");
                        }
                        if (contrasena.match(/[A-z]/)) {} else {
                            alert("La contraseña debe poseer al menos una letra. Vuelve a intentarlo.");
                        }
                        if (contrasena.match(/[A-Z]/)) {} else {
                            alert("La contraseña debe poseer al menos una letra Mayúscula. Vuelve a intentarlo.");
                        }
                        if (contrasena.match(/[0-9]/)) {} else {
                            alert("La contraseña debe poseer al menos un número. Vuelve a intentarlo.");
                        }
                    }
                }
            </script>
            <div class="form-group input">
                <label for="confirmarContrasena">Confirmar Contraseña</label>

                <input type="password" class="form-control input2" id="confirmarContrasena" name="confirmarContrasena" onchange="confirmar_contrasenas(this.value)" placeholder="Confirmar Contraseña" Required>
            </div>
            <script>
                function confirmar_contrasenas(confirmacion) {
                    var contrasena = document.getElementById("contrasena").value;
                    if (confirmacion.length == 0) {} else {
                        if (contrasena != confirmacion) {
                            alert("Las contraseñas no coinciden. Vuelve a intentarlo.");
                        }
                    }
                }
            </script>
            <div>
                <button type="submit" class="btn btn-success boton">Desbloquear Cuenta</button>
            </div>
        </form>
    </div>
</body>

</html>