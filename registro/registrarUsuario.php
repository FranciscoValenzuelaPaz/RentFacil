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
  if (mensaje == "error") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Error al registrar Usuario, porfavor vuelve a intentarlo.</p>
                    `,
    });

  }
  if (mensaje == "existe") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">El nombre de usuario o correo electrónico ya existe en la base de datos.</p>
                    `,
    });
  }

</script>

<body>
  <br>
  <style>
    .formulario {
      width: 50% !important;
      margin-left: 25% !important;
    }
  </style>

  <div class="">
    <div class="fs-2">Registrarse</div>
    <br>
    <form name="form1" action="validarUsuario.php" method="POST">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <br>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa Nombre" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
    event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
    event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
    event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
      </div>
      <br>
      <div class="form-group">
        <label for="apellido">Apellido</label>
        <br>
        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa Apellido" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
    event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
    event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
    event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
      </div>
      <br>
      <div class="form-group">
        <label for="rut">Rut</label>
        <br>
        <input type="text" class="form-control" id="rut" name="rut" min="0" maxlength="10" placeholder="12345678-9"
          onchange="validar_rut(this.value)"
          oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
    event.charCode <= 57 || event.charCode == 45 || event.charCode == 107 || 
    event.charCode == 75" Required>
      </div>

      <script>
        var Fn = {
          // Valida el rut con su cadena completa "XXXXXXXX-X"
          validaRut: function (rutCompleto) {
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
              return false;
            var tmp = rutCompleto.split('-');
            var digv = tmp[1];
            var rut = tmp[0];
            if (digv == 'K') digv = 'k';
            return (Fn.dv(rut) == digv);
          },
          dv: function (T) {
            var M = 0, S = 1;
            for (; T; T = Math.floor(T / 10))
              S = (S + T % 10 * (9 - M++ % 6)) % 11;
            return S ? S - 1 : 'k';
          }
        }
        function validar_rut(rutCampo) {
          if (Fn.validaRut(rutCampo) == true) {

          } else {
            Swal.fire({
              html: `
                    <p style="text-align:justify;">Formato Inválido, porfavor vuelve a intentarlo.</p>
                    `,
            });
          }

        }
  // Uso de la función

      </script>

      <br>
      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <br>
        <input type="text" class="form-control" id="telefono" name="telefono" min="0" maxlength="12"
          placeholder="+56912345678"
          oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
    event.charCode <= 57 || event.charCode == 43" Required>
      </div>
      <br>
      <div class="form-group">
        <label for="email">Email</label>
        <br>
        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa Email" Required>
      </div>
      <br>
      <div class="form-group">
        <label for="contrasena">Contraseña</label>
        <br>
        <input type="password" class="form-control" id="contrasena" name="contrasena"
          onchange="validar_contrasena(this.value)" placeholder="Ingresa Contraseña" Required>
      </div>
      <script>
        function validar_contrasena(contrasena) {
          if (contrasena.length == 0) { } else {
            if (contrasena.length < 8) {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe tener mínimo 8 caracteres. Vuelve a intentarlo.</p>
                    `,
              });
            }
            if (contrasena.match(/[A-z]/)) { } else {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe poseer al menos una letra. Vuelve a intentarlo.</p>
                    `,
              });
            }
            if (contrasena.match(/[A-Z]/)) { } else {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe poseer al menos una letra Mayúscula. Vuelve a intentarlo.</p>
                    `,
              });
            }
            if (contrasena.match(/[0-9]/)) { } else {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe poseer al menos un número. Vuelve a intentarlo.</p>
                    `,
              });
            }
          }

        }
      </script>
      <br>
      <div class="form-group">
        <label for="confirmarContrasena">Confirmar Contraseña</label>
        <br>
        <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena"
          onchange="confirmar_contrasenas(this.value)" placeholder="Confirmar Contraseña" Required>
      </div>
      <script>
        function confirmar_contrasenas(confirmacion) {
          var contrasena = document.getElementById("contrasena").value;
          if (confirmacion.length == 0) { } else {
            if (contrasena != confirmacion) {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">Las contraseñas no coinciden. Vuelve a intentarlo.</p>
                    `,
              });
            }
          }

        }
      </script>
      <br>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="ok" id="terminos" name="terminos" Required>
        <label class="form-check-label" for="terminos">
          Acepto los Términos y Condiciones
        </label>
      </div>
      <br>
      <button type="submit" class="btn btn-success">Ingresar</button><br><br>
      <a href="../inicioSesion/iniciarSesion.php" class="link-success">Ya tienes una Cuenta. Inicia Sesión</a>
    </form>
    <br><br>


  </div>
</body>

</html>

</body>

</html>