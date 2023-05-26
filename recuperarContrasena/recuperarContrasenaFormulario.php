<?php
include("../Header-Footer/header3.php");
if(isset($_GET['email'])){
    $email = $_GET['email'];
}else{
    $email = '';
}
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
    <form action="recuperar.php" method="POST">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <div class="form-group">
    <label for="contrasena">Nueva Contraseña</label>
    <br>
    <input type="password" class="form-control" id="contrasena" name="contrasena" 
    onchange="validar_contrasena(this.value)" placeholder="Ingresa Contraseña" Required>
        </div>
        <script>
            function validar_contrasena(contrasena){
            if(contrasena.length == 0){}else{
                if(contrasena.length < 8 ){
                alert("La contraseña debe tener mínimo 8 caracteres. Vuelve a intentarlo.");
                }
                if(contrasena.match(/[A-z]/)){}else{
                alert("La contraseña debe poseer al menos una letra. Vuelve a intentarlo.");
                }
                if(contrasena.match(/[A-Z]/)){}else{
                alert("La contraseña debe poseer al menos una letra Mayúscula. Vuelve a intentarlo.");
                }
                if(contrasena.match(/[0-9]/)){}else{
                alert("La contraseña debe poseer al menos un número. Vuelve a intentarlo.");
                }
            }
            
            }
        </script>
        <br>
        <div class="form-group">
            <label for="confirmarContrasena">Confirmar Contraseña</label>
            <br>
            <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena" onchange="confirmar_contrasenas(this.value)" placeholder="Confirmar Contraseña" Required>
        </div>
        <script>
            function confirmar_contrasenas(confirmacion){
            var contrasena = document.getElementById("contrasena").value; 
            if(confirmacion.length == 0){}else{
                if(contrasena != confirmacion){
                alert("Las contraseñas no coinciden. Vuelve a intentarlo.");
            }
            }
            
            }
        </script>
        <br>
        <button type="submit" class="btn btn-success">Guardar Nueva Contraseña</button><br><br>
    </form>
    </div>
</body>

</html>