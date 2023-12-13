<style>
    <?php include("../CSS/adminRegistrarEstacionamiento.css"); ?>
</style>

<body>
    <div class="container">
        <?php
        include("../Header-Footer/header4.php");
        ?>
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
                //     <p style="text-align:justify;">Formato de Archivo Inválido. Porfavor vuelve a intentarlo.</p>
                //     `,
                // });
                alert("Formato de Archivo Inválido. Porfavor vuelve a intentarlo.")
            }
        </script>

        <div class="fs-3 titulo">INGRESAR ESTACIONAMIENTO</div>
        <form name="form1" action="registrar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

           
            <div class="form-group label">
                <label for="id_region">Región</label>
                <select class="form-select input" aria-label="Default select example" name='id_region' id="id_region" onchange="marcarCiudad(this.value,'<?php echo $id_usuario; ?>')" Required>
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
                        window.location.href = "registrarEstacionamiento.php?id_usuario=" + id_usuario + "&region=" + region;
                    } else
                        alert('No ha seleccionado ninguna Región');
                    //document.location.href="modificarEstado.php?id="+id;
                }
            </script>
            <div class="form-group label">
                <label for="id_ciudad">Ciudad</label>
                <select class="form-select input" aria-label="Default select example" name='id_ciudad' id="id_ciudad" onchange="marcarComuna(this.value,'<?php echo $id_usuario; ?>','<?php echo $region; ?>')" Required>
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
                        window.location.href = "registrarEstacionamiento.php?id_usuario=" + id_usuario + "&region=" + region + "&ciudad=" + ciudad;
                    } else
                        alert('No ha seleccionado ninguna Ciudad');
                    //document.location.href="modificarEstado.php?id="+id;
                }
            </script>
            <div class="form-group label">
                <label for="id_comuna">Comuna</label>

                <select class="form-select input" aria-label="Default select example" name='id_comuna' id="id_comuna" Required>
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
            </div>
            
            <div class="form-group label">
                <label for="ubicacion">Ubicación</label>
                <input type="text" class="form-control input" id="ubicacion" name="ubicacion" placeholder="Ingresar Ubicación" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
            </div>
            <div class="form-group label">
                <label for="usuario">Usuario</label>

                <select class="form-select input" aria-label="Default select example" name='usuario' id="usuario" Required>
                    <option value="" selected>Selecciona un Usuario</option>
                    <?php
                    $stmt = $dbh->prepare("SELECT * FROM tabla_usuario");
                    // Especificamos el fetch mode antes de llamar a fetch()
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    // Ejecutamos
                    $stmt->execute();
                    // Mostramos los resultados
                    while ($row = $stmt->fetch()) {
                        $nombre = $row['nombre']." ".$row['apellido']; 
                        echo '<option value="' . $row['id_usuario'] . '">' . $nombre . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group label">
                <label for="titulo">Título</label>
                <input type="text" class="form-control input" id="titulo" name="titulo" placeholder="Ingresar Título" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
            </div>
            <div class="form-group label">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control input" id="fecha" name="fecha" Required>
            </div>
            <div class="form-group label">
                <label for="montoArriendo">Monto Arriendo x Día</label>
                <input type="text" class="form-control input" id="montoArriendo" name="montoArriendo" onkeypress="return event.charCode >= 48 && event.charCode <= 57" Required>
            </div>
            <div class="form-group label">
                <label for="montoArriendo2">Monto Arriendo x Hora</label>
                <input type="text" class="form-control input" id="montoArriendo2" name="montoArriendo2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" Required>
            </div>
            <div class="form-group label">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control input" placeholder="Ingresa Descripción" id="descripcion" name="descripcion" rows="10" cols="50"></textarea>
            </div>
            <div class="form-group label">
                <label for="link_foto">Subir Foto</label>
                <input type="file" accept="image/*" class="form-control input" id="link_foto" name="link_foto" required>
            </div>
            <div class="d-flex margenBoton">
                <button type="submit" class="btn btn-success" id="btnIngresarDireccion" name="btnIngresarDireccion">Ingresar</button>&nbsp;&nbsp;
                <input type="button" class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudEstacionamiento.php?id_usuario=<?php echo $id_usuario; ?>'">
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