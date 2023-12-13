<style>
    <?php include("../../../CSS/registrarMaquinariaFormulario.css"); ?><?php include("../../../Header-Footer/header5.php"); ?>
</style>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Maquinarias</title>
</head>

<body>

    <?php

    if (isset($_GET['id_usuario'])) {
        $id_usuario = $_GET['id_usuario'];
    } else {
        $id_usuario = "";
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
    ?>
    <script>
        var mensaje = "<?php echo $mensaje; ?>";
        if (mensaje == "formato_invalido") {
            // Swal.fire({
            //     html: `
            //         <p style="text-align:justify;">Formato de Archivo Inválido. Porfavor vuelve a intentarlo.</p>
            //         `,
            // });
            alert("Formato de Archivo Inválido. Porfavor vuelve a intentarlo.")
        }
    </script>

    <form name="form1" action="registrar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <div class="fs-2 mb-1 mt"><i class="fa-solid fa-tractor fa-beat-fade"></i> INGRESAR MAQUINARIA</div>
        <div class="container_r_maquinaria mt">
            <div class="row">
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">

                            <label for="id_region">Región</label>
                            <select class="form-select" aria-label="Default select example" name='id_region' id="id_region" onchange="marcarCiudad(this.value,'<?php echo $id_usuario; ?>')" Required>
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
                                    if ($region == $row['id_region']) {
                                        echo 'selected';
                                    }
                                    echo '>' . $row['nombre_region'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            function marcarCiudad(region, id_usuario) {
                                // alert("Hola");
                                var region = region;
                                var id_usuario = id_usuario;
                                if (region != "" && id_usuario != "") {
                                    window.location.href = "registrarMaquinaria.php?id_usuario=" + id_usuario + "&region=" + region;
                                } else
                                    alert('No ha seleccionado ninguna Región');
                                //document.location.href="modificarEstado.php?id="+id;
                            }
                        </script>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="id_ciudad">Ciudad</label>

                            <select class="form-select" aria-label="Default select example" name='id_ciudad' id="id_ciudad" onchange="marcarComuna(this.value,'<?php echo $id_usuario; ?>','<?php echo $region; ?>')" Required>
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
                                    if ($ciudad == $row['id_ciudad']) {
                                        echo 'selected';
                                    }
                                    echo '>' . $row['nombre_ciudad'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            function marcarComuna(ciudad, id_usuario, region) {
                                // alert("Hola");
                                var region = region;
                                var id_usuario = id_usuario;
                                var ciudad = ciudad;
                                if (region != "" && id_usuario != "" && ciudad != "") {
                                    window.location.href = "registrarMaquinaria.php?id_usuario=" + id_usuario + "&region=" + region + "&ciudad=" + ciudad;
                                } else
                                    alert('No ha seleccionado ninguna Ciudad');
                                //document.location.href="modificarEstado.php?id="+id;
                            }
                        </script>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-column">
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
                                    echo '<option value="' . $row['id_comuna'] . '">' . $row['nombre_comuna'] . '</option>';
                                }
                                ?>

                            </select>
                            <script>
                                function marcarComuna(ciudad, id_usuario, region) {
                                    // alert("Hola");
                                    var region = region;
                                    var id_usuario = id_usuario;
                                    var ciudad = ciudad;
                                    if (region != "" && id_usuario != "" && ciudad != "") {
                                        window.location.href = "registrarMaquinaria.php?id_usuario=" + id_usuario + "&region=" + region + "&ciudad=" + ciudad;
                                    } else
                                        alert('No ha seleccionado ninguna Ciudad');
                                    //document.location.href="modificarEstado.php?id="+id;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="ubicacion">Ubicación</label>

                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresar Ubicación" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresar Título" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select class="form-select" aria-label="Default select example" name='tipo' id="tipo" Required>
                                <option value="" selected>Selecciona un Tipo</option>
                                <?php
                                $arrayTipos = array("Dummy", "Excavadora", "Retroexcavadora", "Tractor", "Cargador Frontal", "Pavimentadora", "Compactadora", "Grua", "Hormigonera", "Rompepavimientos", "Retropala", "Generador");
                                for ($i = 1; $i < count($arrayTipos); $i++) {
                                    echo '<option value="' . $i . '">' . $arrayTipos[$i] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Puedes continuar añadiendo más filas según sea necesario -->

            <div class="row">
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>

                            <input type="date" class="form-control" id="fecha" name="fecha" Required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="bencina">Combustible</label>

                            <select class="form-select" aria-label="Default select example" name='bencina' id="bencina" Required>
                                <option value="" selected>Selecciona Con/Sin Combustible</option>
                                <option value="1">Con Combustible</option>
                                <option value="2">Sin Combustible</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="montoArriendo">Monto Arriendo</label>
                            <input type="text" class="form-control" id="montoArriendo" name="montoArriendo" placeholder="Ingrese Monto" onkeypress="return event.charCode >= 48 && event.charCode <= 57" Required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group input">
                            <label for="link_foto">Subir Foto</label>

                            <input type="file" accept="image/*" class="form-control" id="link_foto" name="link_foto" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control txtdescripcion" placeholder="Ingresa Descripción" id="descripcion" name="descripcion" rows="1" cols="50"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success" id="btnIngresarDireccion" name="btnIngresarDireccion">Ingresar</button>
                <input type="button" class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudMaquinaria.php?id_usuario=<?php echo $id_usuario; ?>'">
            </div>
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
<footer>
    <?php include("../../../Header-Footer/footer3.php"); ?>
</footer>

</html>