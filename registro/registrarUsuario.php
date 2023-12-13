<style>
  <?php include("../CSS/registrarUsuario.css"); ?><?php include("../Header-Footer/header3.php"); ?>
</style>
<?php
if (isset($_GET['mensaje'])) {
  $mensaje = $_GET['mensaje'];
} else {
  $mensaje = '';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
</head>

<body>

  <script>
    // script para mostrar mensaje si el usuario a sido registrado correctamente
    let mensaje = "<?php echo $mensaje; ?>";
    if (mensaje == "error") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Error al registrar Usuario, porfavor vuelve a intentarlo.</p>
      //               `,
      // });
      alert("Error al registrar Usuario, porfavor vuelve a intentarlo.")

    }
    if (mensaje == "existe") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">El nombre de usuario o correo electrónico ya existe en la base de datos.</p>
      //               `,
      // });
      alert("El nombre de usuario o correo electrónico ya existe en la base de datos.")
    }
    if (mensaje == "vacio") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Porfavor, rellene todos los campos del formulario.</p>
      //               `,
      // });
      alert("Porfavor, rellene todos los campos del formulario.")
    }
  </script>

  <div class="form-container">
    <form name="form" action="validarUsuario.php" method="POST">
      <div class="fs-2 txt"><i class="fa-solid fa-user fa-beat-fade"></i> REGISTRATE</div>
      <div class="mg">
        <div class="container mt-4">
          <div class="row mb-3">
            <div class="col-sm-4">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-user"></i>
                </span>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa Nombre" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
                        event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
                        event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
                        event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-user"></i>
                </span>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa Apellido" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
                        event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
                        event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
                        event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-4">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-envelope"></i>
                </span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa Email" Required>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-key"></i>
                </span>
                <input type="password" class="form-control" id="contrasena" name="contrasena" onchange="validar_contrasena(this.value)" placeholder="Ingresa Contraseña" Required>
              </div>
              <script>
                function validar_contrasena(contrasena) {
                  if (contrasena.length == 0) {} else {
                    if (contrasena.length < 8) {
                    //   Swal.fire({
                    //     html: `
                    // <p style="text-align:justify;">La contraseña debe tener mínimo 8 caracteres. Vuelve a intentarlo.</p>
                    // `,
                    //   });
                      alert("La contraseña debe tener mínimo 8 caracteres. Vuelve a intentarlo.")
                    }
                    if (contrasena.match(/[A-z]/)) {} else {
                    //   Swal.fire({
                    //     html: `
                    // <p style="text-align:justify;">La contraseña debe poseer al menos una letra. Vuelve a intentarlo.</p>
                    // `,
                    //   });
                      alert("La contraseña debe poseer al menos una letra. Vuelve a intentarlo.")
                    }
                    if (contrasena.match(/[A-Z]/)) {} else {
                    //   Swal.fire({
                    //     html: `
                    // <p style="text-align:justify;">La contraseña debe poseer al menos una letra Mayúscula. Vuelve a intentarlo.</p>
                    // `,
                    //   });
                      alert("La contraseña debe poseer al menos una letra Mayúscula. Vuelve a intentarlo.")
                    }
                    if (contrasena.match(/[0-9]/)) {} else {
                    //   Swal.fire({
                    //     html: `
                    // <p style="text-align:justify;">La contraseña debe poseer al menos un número. Vuelve a intentarlo.</p>
                    // `,
                    //   });
                      alert("La contraseña debe poseer al menos un número. Vuelve a intentarlo.")
                    }
                  }

                }
              </script>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-4">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-phone"></i>
                </span>
                <input type="text" class="form-control" id="telefono" name="telefono" min="0" maxlength="12" placeholder="Ingresa Fono (+56912345678)" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
                        event.charCode <= 57 || event.charCode == 43" Required>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-key"></i>
                </span>
                <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena" onchange="confirmar_contrasenas(this.value)" placeholder="Confirmar Contraseña" Required>
              </div>
              <script>
                function confirmar_contrasenas(confirmacion) {
                  var contrasena = document.getElementById("contrasena").value;
                  if (confirmacion.length == 0) {} else {
                    if (contrasena != confirmacion) {
                    //   Swal.fire({
                    //     html: `
                    // <p style="text-align:justify;">Las contraseñas no coinciden. Vuelve a intentarlo.</p>
                    // `,
                    //   });
                      alert("Las contraseñas no coinciden. Vuelve a intentarlo.")
                    }
                  }
                }
              </script>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-4">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-id-card"></i>
                </span>
                <input type="text" class="form-control" id="rut" name="rut" min="0" maxlength="10" placeholder="Ingresa Rut (12345678-9)" onchange="validar_rut(this.value)" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
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
                    // Swal.fire({
                    //   html: `
                    // <p style="text-align:justify;">Formato de RUT Inválido, porfavor vuelve a intentarlo.</p>
                    // `,
                    // });
                    alert("Formato de RUT Inválido, porfavor vuelve a intentarlo.")
                  }

                }
              </script>
            </div>

            <div class="col-sm-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ok" id="terminos" name="terminos" Required>
                <label class="form-check-label" for="terminos">Acepto los Términos y Condiciones
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <button type="submit" class="btn btn-success m-3">Ingresar</button>
      </div>
      <div>
        <div><a href="../inicioSesion/formularioRecuperarContrasena.php" class="link-light">Olvidé mi contraseña</a></div>
        <div><a href="../inicioSesion/formularioDesbloquearCuenta.php" class="link-light">Desbloquear Cuenta</a></div>
      </div>
    </form>
  </div>
  </div>

  <!-- Agrega el enlace al archivo JavaScript de Bootstrap y al archivo Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofNolhT+2vHJfL+6z5lFf6n6qt7uo5be5/" crossorigin="anonymous"></script>

</body>

</html>