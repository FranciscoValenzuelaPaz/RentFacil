<style>
    <?php include("../CSS/editarDireccionesFormulario.css"); ?>
</style>

<?php
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");

?>
<html>

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

if (isset($_GET['id_usuario']) && isset($_GET['id_direccion'])) {
    $id_usuario = $_GET['id_usuario'];
    $id_direccion = $_GET['id_direccion'];
} else {
    $id_usuario = "";
    $id_direccion = "";
}
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}

if (isset($_GET['region'])) {
    $region = $_GET['region'];
} else {
    $region = "";
}
if (isset($_GET['ciudad'])) {
    $ciudad = $_GET['ciudad'];
} else {
    $ciudad = "";
}
$stmt = $dbh->prepare("SELECT * FROM tabla_direcciones WHERE id_direccion='$id_direccion'");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
while ($row = $stmt->fetch()) {
    $id_region = $row["id_region"];
    $id_ciudad = $row["id_ciudad"];
    $id_comuna = $row["id_comuna"];
    $direccion = $row["direccion"];
    $tipo_direccion = $row["tipo_direccion"];
}
?>
<script>
    var mensaje = "<?php echo $mensaje; ?>";
    if (mensaje == "formato_invalido") {
        // Swal.fire({
        //     html: `
        //             <p style="text-align:justify;">Formato de Archivo Inválido. Porfavor vuelve a intentarlo.</p>
        //             `,
        // });
        alert("Formato de Archivo Inválido. Porfavor vuelve a intentarlo.")
    }
</script>

<body>
    <div class="fs-4 titulo">EDITAR DIRECCIONES</div>
    <form name="form1" action="editar.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <input type="hidden" name="id_direccion" value="<?php echo $id_direccion; ?>">
        <div class="form-group">
            <label for="id_region">Región</label>
            <select class="form-select" aria-label="Default select example" name='id_region' id="id_region" onchange="marcarCiudad(this.value,'<?php echo $id_usuario; ?>','<?php echo $id_direccion; ?>')" Required>
                <option value="" selected>Selecciona una Región</option>
                <?php
                $stmt = $dbh->prepare("SELECT * FROM tabla_regiones");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_region'] . '"';
                    if ($row['id_region'] == $region) {
                        echo 'selected';
                    } else {
                        if ($row['id_region'] == $id_region) {
                            echo 'selected';
                        }
                    }
                    echo '>' . $row['nombre_region'] . '</option>';
                }
                ?>
            </select>
        </div>
        <script>
            function marcarCiudad(region, id_usuario, id_direccion) {
                // alert("Hola");
                var region = region;
                var id_usuario = id_usuario;
                var id_direccion = id_direccion;
                if (region != "" && id_usuario != "" && id_direccion != "") {
                    window.location.href = "editarDireccion.php?id_usuario=" + id_usuario + "&region=" + region + "&id_direccion=" + id_direccion;
                } else
                    alert('No ha seleccionado ninguna Región');
                //document.location.href="modificarEstado.php?id="+id;
            }
        </script>
        <div class="form-group">
            <label for="id_ciudad">Ciudad</label>

            <select class="form-select" aria-label="Default select example" name='id_ciudad' id="id_ciudad" onchange="marcarComuna(this.value,'<?php echo $id_usuario; ?>','<?php echo $region; ?>','<?php echo $id_direccion; ?>')" Required>
                <option value="" selected>Selecciona una Ciudad</option>
                <?php
                if (!empty($region)) {
                    $stmt = $dbh->prepare("SELECT * FROM tabla_ciudades WHERE id_region='$region'");
                } else {
                    $stmt = $dbh->prepare("SELECT * FROM tabla_ciudades");
                }
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_ciudad'] . '"';
                    if (!empty($ciudad)) {
                        if ($row['id_ciudad'] == $ciudad) {
                            echo 'selected';
                        }
                    } else {
                        if (!empty($region)) {
                        } else {
                            if ($row['id_ciudad'] == $id_ciudad) {
                                echo 'selected';
                            }
                        }
                    }
                    echo '>' . $row['nombre_ciudad'] . '</option>';
                }
                ?>
            </select>
        </div>
        <script>
            function marcarComuna(ciudad, id_usuario, region, id_direccion) {
                // alert("Hola");
                var region = region;
                var id_usuario = id_usuario;
                var ciudad = ciudad;
                var id_direccion = id_direccion;
                if (region != "" && id_usuario != "" && ciudad != "" && id_direccion != "") {
                    window.location.href = "editarDireccion.php?id_usuario=" + id_usuario + "&region=" + region + "&ciudad=" + ciudad + "&id_direccion=" + id_direccion;
                } else
                    alert('No ha seleccionado ninguna Ciudad');
                //document.location.href="modificarEstado.php?id="+id;
            }
        </script>
        <div class="form-group">
            <label for="id_comuna">Comuna</label>
            <select class="form-select" aria-label="Default select example" name='id_comuna' id="id_comuna" Required>
                <option value="" selected>Selecciona una Comuna</option>
                <?php
                if (!empty($region)) {
                    $stmt = $dbh->prepare("SELECT * FROM tabla_comunas WHERE id_ciudad='$ciudad'");
                } else {
                    $stmt = $dbh->prepare("SELECT * FROM tabla_comunas");
                }
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_comuna'] . '"';
                    if (!empty($region)) {
                    } else {
                        if ($row['id_comuna'] == $id_comuna) {
                            echo "selected";
                        }
                    }
                    echo '>' . $row['nombre_comuna'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>

            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa Dirección" value="<?php echo $direccion; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
        </div>
        <div class="form-group">
            <label for="tipo_direccion">Tipo</label>
            <select class="form-select" aria-label="Default select example" name="tipo_direccion" id="tipo_direccion" Required>
                <option value="" selected>Selecciona un Tipo</option>
                <?php
                $arrayAux = array('Dummy', 'Empresa', 'Domicilio', 'Estacionamiento', 'Obra');
                for ($i = 1; $i < count($arrayAux); $i++) {
                    echo '<option value="' . $i . '"';
                    if ($i == $tipo_direccion) {
                        echo "selected";
                    }
                    echo '>' . $arrayAux[$i] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="d-flex ctrl">
            <button type="submit" class="btn btn-success" id="btnEditarDireccion" name="btnEditarDireccion">Guardar Cambios</button>&nbsp;&nbsp;
            <input type="button" class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudDirecciones.php?id_usuario=<?php echo $id_usuario; ?>'">
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