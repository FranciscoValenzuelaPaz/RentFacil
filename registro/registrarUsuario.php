<style>
  <?php include("../CSS/registrarUsuario.css"); ?>
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
  if (mensaje == "vacio") {
    Swal.fire({
      html: `
                    <p style="text-align:justify;">Porfavor, rellene todos los campos del formulario.</p>
                    `,
    });
  }
</script>
<html>

<body class="body">
  <div class="fondoformulario">
    <div class="fs-1 margen inicio">REGISTRARSE</div>
    <form name="form" action="validarUsuario.php" method="POST">
      <div class="form-group col-sm-4 margen">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control input2" id="nombre" name="nombre" placeholder="Ingresa Nombre" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
        event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
        event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
        event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
      </div>
      <div class="form-group col-sm-4 margen">
        <label for="apellido">Apellido</label>
        <input type="text" class="form-control input2" id="apellido" name="apellido" placeholder="Ingresa Apellido" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
        event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
        event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
        event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
      </div>
      <div class="form-group col-sm-4 margen">
        <label for="rut">Rut</label>
        <input type="text" class="form-control input2" id="rut" name="rut" min="0" maxlength="10" placeholder="12345678-9" onchange="validar_rut(this.value)" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
        event.charCode <= 57 || event.charCode == 45 || event.charCode == 107 || 
        event.charCode == 75" Required>
      </div>
      <script>
        var Fn = {
          // Valida el rut con su cadena completa "XXXXXXXX-X"
          validaRut: function(rutCompleto) {
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
              return false;
            var tmp = rutCompleto.split('-');
            var digv = tmp[1];
            var rut = tmp[0];
            if (digv == 'K') digv = 'k';
            return (Fn.dv(rut) == digv);
          },
          dv: function(T) {
            var M = 0,
              S = 1;
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
      <div class="form-group col-sm-4 margen">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control input2" id="telefono" name="telefono" min="0" maxlength="12" placeholder="+56912345678" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
    event.charCode <= 57 || event.charCode == 43" Required>
      </div>
      <div class="form-group col-sm-4 margen">
        <label for="email">Email</label>
        <input type="email" class="form-control input2" id="email" name="email" placeholder="Ingresa Email" Required>
      </div>
      <div class="form-group col-sm-4 margen">
        <label for="contrasena">Contraseña</label>
        <input type="password" class="form-control input2" id="contrasena" name="contrasena" onchange="validar_contrasena(this.value)" placeholder="Ingresa Contraseña" Required>
      </div>
      <script>
        function validar_contrasena(contrasena) {
          if (contrasena.length == 0) {} else {
            if (contrasena.length < 8) {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe tener mínimo 8 caracteres. Vuelve a intentarlo.</p>
                    `,
              });
            }
            if (contrasena.match(/[A-z]/)) {} else {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe poseer al menos una letra. Vuelve a intentarlo.</p>
                    `,
              });
            }
            if (contrasena.match(/[A-Z]/)) {} else {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe poseer al menos una letra Mayúscula. Vuelve a intentarlo.</p>
                    `,
              });
            }
            if (contrasena.match(/[0-9]/)) {} else {
              Swal.fire({
                html: `
                    <p style="text-align:justify;">La contraseña debe poseer al menos un número. Vuelve a intentarlo.</p>
                    `,
              });
            }
          }

        }
      </script>
      <div class="form-group col-sm-4 margen">
        <label for="confirmarContrasena">Confirmar Contraseña</label>
        <input type="password" class="form-control input2" id="confirmarContrasena" name="confirmarContrasena" onchange="confirmar_contrasenas(this.value)" placeholder="Confirmar Contraseña" Required>
      </div>
      <script>
        function confirmar_contrasenas(confirmacion) {
          var contrasena = document.getElementById("contrasena").value;
          if (confirmacion.length == 0) {} else {
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
      <div class="form-check col-sm-4 margen  ">
        <input class="form-check-input" type="checkbox" value="ok" id="terminos" name="terminos" Required>
        <label class="form-check-label" for="terminos">
          Acepto los Términos y Condiciones
        </label>
      </div>
      <div>
        <button type="submit" class="btn btn-success input2">Ingresar</button>
      </div>
      </form>
      <div class="fin">
        <a href="../inicioSesion/iniciarSesion.php" class="link-secondary">Ya tienes una Cuenta. Inicia Sesión</a>
      </div>
  </div>
</body>

</html>