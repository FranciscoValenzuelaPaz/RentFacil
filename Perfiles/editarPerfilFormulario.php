<style>
  <?php include("../CSS/editarPerfilFormulario.css"); ?><?php include("../Header-Footer/header2.php"); ?>
</style>

<?php
include("../encriptarContrasena/encriptarClave.php");

if (isset($_GET['id_usuario'])) {
  $id_usuario = $_GET['id_usuario'];
} else {
  $id_usuario = '';
}
if (isset($_GET['mensaje'])) {
  $mensaje = $_GET['mensaje'];
} else {
  $mensaje = '';
}
$id_usuario_original = $desencriptar($id_usuario);
$stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE id_usuario='$id_usuario_original'");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
while ($row = $stmt->fetch()) {

  $nombre = $row["nombre"];
  $apellido = $row["apellido"];
  $telefono = $row["telefono"];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Maquinarias</title>
</head>

<body>


  <script>
    // script para mostrar mensaje si el usuario a sido registrado correctamente
    let mensaje = "<?php echo $mensaje; ?>";
    if (mensaje == "ok") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">El usuario ha sido registrado con éxito.</p>
      //               `,
      // });
      alert("El usuario ha sido registrado con éxito.")
    }

    //script segun estado del usuario 1:sin verificar,3:usuario bloqueado
    if (mensaje == "sin_verificar") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Usuario sin Verificar, porfavor revise correo de confirmación.</p>
      //               `,
      // });
      alert("Usuario sin Verificar, porfavor revise correo de confirmación.")
    }
    if (mensaje == "bloqueado") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Usuario Bloqueado. Contactar con Administrador.</p>
      //               `,
      // });
      alert("Usuario Bloqueado. Contactar con Administrador.")
    }

    //script cuando el correo y la contrasena no coinciden
    if (mensaje == "no_coincide") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Usuario y/o Contraseña no coinciden.Vuelve a intentarlo.</p>
      //               `,
      // });
      alert("Usuario y/o Contraseña no coinciden.Vuelve a intentarlo.")
    }
    //script cuando un usuario intenta iniciar con una cuenta no registrada
    if (mensaje == "no_registrado") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">El correo ingresado NO se encuentra registrado.</p>
      //               `,
      // });
      alert("El correo ingresado NO se encuentra registrado.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "validado") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Su cuenta ha sido Validada con éxito.</p>
      //               `,
      // });
      alert("Su cuenta ha sido Validada con éxito.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "noValidado") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Error al validar la Cuenta.</p>
      //               `,
      // });
      alert("Error al validar la Cuenta.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "cambioContrasena") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">La contraseña se actualizó con éxito.</p>
      //               `,
      // });
      alert("La contraseña se actualizó con éxito.")
    }
    //script cuando un usuario ha sido desbloqueado
    if (mensaje == "cuenta_desbloqueada") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Cuenta Desbloqueada.</p>
      //               `,
      // });
      alert("Cuenta Desbloqueada.")
    }
    //script cuando un usuario ha sido validado a traves de email
    if (mensaje == "no_desbloquea") {
      // Swal.fire({
      //   html: `
      //               <p style="text-align:justify;">Error al desbloquear la Cuenta. Porfavor vuelve a Intentarlo.</p>
      //               `,
      // });
      alert("Error al desbloquear la Cuenta. Porfavor vuelve a Intentarlo.")
    }
  </script>
  <script>
    var mensaje = "<?php echo $mensaje; ?>";
    if (mensaje == "actualizado") {
      alert('Perfil Actualizado con éxito.')
    }
    if (mensaje == "error_actualizar") {
      alert('Error al Actualizar los datos. Porfavor vuelve a intentarlo.');
    }
  </script>


  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-4 mt-5">
        <div class="custom-column">
          <form name="form1" action="editarPerfil.php" method="POST">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <div class="form-group">
              <div class="fs-2 mt-3 mb-3"><i class="fa-solid fa-user fa-beat-fade"></i> EDITAR PERFIL</div>
              <label for="nombre">Nombre</label>

              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa Nombre" value="<?php echo $nombre; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
            </div>

            <div class="form-group">
              <label for="apellido">Apellido</label>

              <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa Apellido" value="<?php echo $apellido; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
            </div>

            <div class="form-group">
              <label for="telefono">Teléfono</label>

              <input type="text" class="form-control" id="telefono" name="telefono" min="0" maxlength="12" value="<?php echo $telefono; ?>" placeholder="+56912345678" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
              event.charCode <= 57 || event.charCode == 43" Required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-success mx-auto mt-2" id="btnEditarPerfil" name="btnEditarPerfil">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-4">
        <div class="custom-column">
          <div class="form-group">
            <iframe src="../Direcciones/crudDirecciones.php?id_usuario=<?php echo $id_usuario; ?>" frameborder="0" width="850" height="600"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
<footer>
  <?php include("../Header-Footer/footer.php"); ?>
</footer>

</html>