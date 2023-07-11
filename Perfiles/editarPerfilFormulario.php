<style>
  <?php include("../CSS/editarPerfilFormulario.css"); ?>
</style>
<div class="container">
  <?php
  include("../Header-Footer/header2.php");

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
  $stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE id_usuario='$id_usuario'");
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

  <script>
    var mensaje = "<?php echo $mensaje; ?>";
    if (mensaje == "actualizado") {
      alert('Perfil Actualizado con éxito.')
    }
    if (mensaje == "error_actualizar") {
      alert('Error al Actualizar los datos. Porfavor vuelve a intentarlo.');
    }
  </script>
  <html>

  <body class="body">
    <div class="formulario ">
      <div class="row">
        <div class="col">
          <div class="fs-2 titulos">EDITAR PERFIL</div>
        </div>
        <div class="col">
          <div class="fs-2 titulos">DIRECCIONES</div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="izquierda">

            <form name="form1" action="editarPerfil.php" method="POST">
              <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
              <div class="form-group margen">
                <label for="nombre">Nombre</label>

                <input type="text" class="form-control input2" id="nombre" name="nombre" placeholder="Ingresa Nombre" value="<?php echo $nombre; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
              </div>

              <div class="form-group margen">
                <label for="apellido">Apellido</label>

                <input type="text" class="form-control input2" id="apellido" name="apellido" placeholder="Ingresa Apellido" value="<?php echo $apellido; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
              </div>

              <div class="form-group margen">
                <label for="telefono">Teléfono</label>

                <input type="text" class="form-control input2" id="telefono" name="telefono" min="0" maxlength="12" value="<?php echo $telefono; ?>" placeholder="+56912345678" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
              event.charCode <= 57 || event.charCode == 43" Required>
              </div>
              <div class="margen">
                <button type="submit" class="btn btn-success  " id="btnEditarPerfil" name="btnEditarPerfil">Guardar Cambios</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col">
          <div class="derecha">
            <iframe src="../Direcciones/crudDirecciones.php?id_usuario=<?php echo $id_usuario; ?>" frameborder="0" width="800" height="600"></iframe>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>