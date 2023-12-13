<style>
  <?php include("../CSS/AdminEditarUsuarios.css"); ?>
</style>
<!DOCTYPE html>
<html lang="en">
<?php
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Sweet Alert Script -->
  <script src="../js/sweetalert.min.js"></script>
  <title></title>
</head>
<?php

if (isset($_GET['id_usuario']) && isset($_GET['usuario'])) {
  $id_usuario = $_GET['id_usuario'];

  $usuario = $_GET['usuario'];
} else {
  $id_usuario = "";
  $usuario = "";
}
$stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE id_usuario='$usuario'");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
while ($row = $stmt->fetch()) {
  $nombre = $row['nombre'];
  $apellido = $row['apellido'];
  $rut = $row['rut'];
  $telefono = $row['telefono'];
  $email = $row['email'];
}

?>

<body>
  <div class="container">
    <div class="fs-2 titulo">Editar usuario</div>
    <form name="form" action="editar.php" method="POST">
      <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
      <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
      <div class="form-group col-sm-4">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa Nombre" value="<?php echo $nombre; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
        event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
        event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
        event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
      </div>
      <div class="form-group col-sm-4">
        <label for="apellido">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa Apellido" value="<?php echo $apellido; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
        event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
        event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
        event.charCode == 243 || event.charCode == 250 || event.charCode == 32" Required>
      </div>

      <div class="form-group col-sm-4">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" min="0" maxlength="12" placeholder="+56912345678" value="<?php echo $telefono; ?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return event.charCode >= 48 &&
    event.charCode <= 57 || event.charCode == 43" Required>
      </div>
      <div class="form-group col-sm-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa Email" value="<?php echo $email; ?>" Required>
      </div>
      <div class="d-flex ctrl" >
        <button type="submit" class="btn btn-dark">Guardar Cambios</button>
      </div>
    </form>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        -->

  </div>
</body>

</html>