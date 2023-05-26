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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Sweet Alert Script -->
    <script src="../js/sweetalert.min.js"></script>
    <title></title>
</head>
<?php

if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    $email = "";
}

?>
<div class="container">
    <div class="fs-3">Ingresar dirección</div>
    <br>
    <form name="form1" action="registrar.php" method="POST">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <div class="form-group">
            <label for="id_region">Región</label>
            <br>
            <select class="form-select" aria-label="Default select example" name='id_region' id="id_region" Required>
                <option value="" selected>Selecciona una Región</option>
                <?php
                $stmt = $dbh->prepare("SELECT * FROM tabla_regiones");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_region'] . '">' . $row['nombre_region'] . '</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="id_ciudad">Ciudad</label>
            <br>
            <select class="form-select" aria-label="Default select example" name='id_ciudad' id="id_ciudad" Required>
                <option value="" selected>Selecciona una Ciudad</option>
                <?php
                $stmt = $dbh->prepare("SELECT * FROM tabla_ciudades");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_ciudad'] . '">' . $row['nombre_ciudad'] . '</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="id_comuna">Comuna</label>
            <br>
            <select class="form-select" aria-label="Default select example" name='id_comuna' id="id_comuna" Required>
                <option value="" selected>Selecciona una Comuna</option>
                <?php
                $stmt = $dbh->prepare("SELECT * FROM tabla_comunas");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_comuna'] . '">' . $row['nombre_comuna'] . '</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <br>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa Dirección"
                onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
        </div>
        <br>
        <div class="form-group">
            <label for="tipo_direccion">Tipo</label>
            <select class="form-select" aria-label="Default select example" name="tipo_direccion" id="tipo_direccion" Required>
                <option value="" selected>Selecciona un Tipo</option>
                <option value="1">Empresa</option>
                <option value="2">Domicilio</option>
                <option value="3">Estacionamiento</option>
                <option value="4">Obra</option>
            </select>
        </div>
        <br>
        <div class="d-flex">
        <button type="submit" class="btn btn-success" id="btnIngresarDireccion" name="btnIngresarDireccion">Ingresar</button>&nbsp;&nbsp;
        <input type="button"  class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudDirecciones.php?email=<?php echo $email;?>'">
        </div>
    </form>




    <br><br>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->

</div>
</body>

</html>