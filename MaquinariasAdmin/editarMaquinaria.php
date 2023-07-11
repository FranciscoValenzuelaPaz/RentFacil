<style>
    <?php include("../CSS/adminEditarMaquinaria.css"); ?>
</style>
<html>

<body class="body">
    <div class="container">
        <?php
        include("../Header-Footer/header4.php");
        if (isset($_GET['id_usuario']) && isset($_GET['id_maquinaria']) && isset($_GET['link'])) {
            $id_usuario = $_GET['id_usuario'];
            $id_maquinaria = $_GET['id_maquinaria'];
            $link_foto = $_GET['link'];
        } else {
            $id_usuario = '';
            $id_maquinaria = '';
            $link_foto = '';
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
        //consulta datos del registro de la maquinaria
        $arrayDatos = array();
        $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias WHERE id_maquinaria='$id_maquinaria' ");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
            $arrayDatos[] = $row;
        }
        //print_r($arrayDatos);
        //consulta para traer la region y ciudad, del registro seleccionado, ya que a nivel de base de datos solo obtenemos el id_comuna
        $id_comuna = $arrayDatos[0]['id_comuna'];
        $usuario = $arrayDatos[0]['id_usuario'];
        $arrayDatos2 = array();
        $stmt = $dbh->prepare("SELECT CO.id_comuna,CI.id_ciudad,R.id_region FROM tabla_comunas as CO JOIN tabla_ciudades as CI ON 
        CO.id_ciudad=CI.id_ciudad JOIN tabla_regiones as R ON CI.id_region=R.id_region WHERE CO.id_comuna='$id_comuna'");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
            $arrayDatos2[] = $row;
        }
        $id_region = $arrayDatos2[0]['id_region'];
        $id_ciudad = $arrayDatos2[0]['id_ciudad'];
        //  echo $id_region."<br>";
        //  echo $id_ciudad;
        ?>
        <script>
            var mensaje = "<?php echo $mensaje; ?>";
            if (mensaje == "formato_invalido") {
                Swal.fire({
                    html: `
                    <p style="text-align:justify;">Formato de Archivo Inválido. Porfavor vuelve a intentarlo.</p>
                    `,
                });
            }
        </script>
        <div>
            <div class="fs-3 titulo">EDITAR MAQUINARIA</div>
            <form name="form1" action="editar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <input type="hidden" name="link_foto" value="<?php echo $link_foto; ?>">
                <input type="hidden" name="id_maquinaria" value="<?php echo $id_maquinaria; ?>">
                <div class="form-group input">
                    <label class="label" for="id_region">Región</label>
                    <select class="form-select input" aria-label="Default select example" name='id_region' id="id_region" onchange="marcarCiudad(this.value,'<?php echo $id_usuario; ?>','<?php echo $id_maquinaria; ?>','<?php echo $link_foto; ?>')" Required>
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
                            if (!empty($region)) {
                                if ($row['id_region'] == $region) {
                                    echo 'selected';
                                }
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
                    function marcarCiudad(region, id_usuario, id_maquinaria, link_foto) {
                        // alert("Hola");
                        var region = region;
                        var id_usuario = id_usuario;
                        var id_maquinaria = id_maquinaria;
                        var link_foto = link_foto;
                        if (region != "" && id_usuario != "" && id_maquinaria != "" && link_foto != "") {
                            window.location.href = "editarMaquinaria.php?id_usuario=" + id_usuario + "&region=" + region + "&id_maquinaria=" + id_maquinaria + "&link=" + link_foto;
                        } else
                            alert('No ha seleccionado ninguna Región');
                        //document.location.href="modificarEstado.php?id="+id;
                    }
                </script>
                <div class="form-group input">
                    <label class="label" for="id_ciudad">Ciudad</label>

                    <select class="form-select input" aria-label="Default select example" name='id_ciudad' id="id_ciudad" onchange="marcarComuna(this.value,'<?php echo $id_usuario; ?>','<?php echo $region; ?>','<?php echo $id_maquinaria; ?>','<?php echo $link_foto; ?>')" Required>
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
                    function marcarComuna(ciudad, id_usuario, region, id_maquinaria, link_foto) {
                        // alert("Hola");
                        var region = region;
                        var id_usuario = id_usuario;
                        var ciudad = ciudad;
                        var link_foto = link_foto;
                        var id_maquinaria = id_maquinaria;
                        if (region != "" && id_usuario != "" && ciudad != "" && id_maquinaria != "" && link_foto != "") {
                            window.location.href = "editarMaquinaria.php?id_usuario=" + id_usuario + "&region=" + region + "&ciudad=" + ciudad + "&id_maquinaria=" + id_maquinaria + "&link=" + link_foto;
                        } else
                            alert('No ha seleccionado ninguna Ciudad');
                        //document.location.href="modificarEstado.php?id="+id;
                    }
                </script>
                <div class="form-group input">
                    <label class="label" for="id_comuna">Comuna</label>
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
                <div class="form-group input">
                    <label class="label" for="ubicacion">Ubicación</label>
                    <input type="text" class="form-control input" id="ubicacion" name="ubicacion" placeholder="Ingresar Ubicación" value="<?php echo $arrayDatos[0]['ubicacion']; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
                </div>
                <div class="form-group input">
                <label class="label" for="usuario">Usuario</label>

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
                        echo '<option value="' . $row['id_usuario'] . '"';
                        if($usuario == $row['id_usuario']){
                            echo "selected";
                        }
                        echo '>' . $nombre . '</option>';
                    }
                    ?>
                </select>
            </div>
                <div class="form-group input">
                    <label class="label" for="titulo">Título</label>
                    <input type="text" class="form-control input " id="titulo" name="titulo" placeholder="Ingresar Título" value="<?php echo $arrayDatos[0]['titulo']; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
                </div>
                <div class="form-group input">
                    <label class="label" for="tipo">Tipo</label>

                    <select class="form-select input" aria-label="Default select example" name='tipo' id="tipo" Required>
                        <option value="" selected>Selecciona un Tipo</option>
                        <?php
                        $arrayTipos = array("Dummy", "Excavadora", "Retroexcavadora", "Tractor", "Cargador Frontal", "Pavimentadora", "Compactadora", "Grua", "Hormigonera", "Rompepavimientos", "Retropala", "Generador");
                        for ($i = 1; $i < count($arrayTipos); $i++) {
                            echo '<option value="' . $i . '"';
                            if ($arrayDatos[0]['tipo'] == $i) {
                                echo "selected";
                            }
                            echo '>' . $arrayTipos[$i] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group input">
                    <label class="label" for="bencina">Combustible</label>

                    <select class="form-select input" aria-label="Default select example" name='bencina' id="bencina" Required>
                        <option value="" selected>Selecciona Con/Sin Combustible</option>
                        <?php
                        $arrayBencina = array("Dummy", "Con Combustible", "Sin Combustible");
                        for ($i = 1; $i < count($arrayBencina); $i++) {
                            echo '<option value="' . $i . '"';
                            if ($arrayDatos[0]['bencina'] == $i) {
                                echo "selected";
                            }
                            echo '>' . $arrayBencina[$i] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group input">
                    <label class="label" for="montoArriendo">Monto Arriendo</label>

                    <input type="text" class="form-control input" id="montoArriendo" name="montoArriendo" value="<?php echo $arrayDatos[0]['montoArriendo']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" Required>
                </div>
                <div class="form-group input">
                    <label class="label " for="descripcion">Descripción</label>
                    <textarea class="form-control " placeholder="Ingresa Descripción" id="descripcion" name="descripcion" rows="10" cols="50"><?php echo $arrayDatos[0]['descripcion']; ?></textarea>

                </div>
                <div class="form-group input">
                    <label class="label" for="link_foto">Subir Foto</label>

                    <input type="file" accept="image/*" class="form-control input" id="link_foto" name="link_foto">
                    <small>(Opcional)</small>
                </div>
                <div class="d-flex margenBoton">
                    <button type="submit" class="btn btn-success" id="btnIngresarDireccion" name="btnIngresarDireccion">Guardar Cambios</button>&nbsp;&nbsp;
                    <input type="button" class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudMaquinaria.php?id_usuario=<?php echo $id_usuario; ?>'">
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