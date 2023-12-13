<style>
    <?php include("../../../CSS/registrarEstacionamientoFormulario.css"); ?><?php include("../../../Header-Footer/header5.php"); ?>
</style>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Maquinarias</title>
</head>

<body>

    <?php

    if (isset($_GET['id_usuario']) && isset($_GET['id_estacionamiento']) && isset($_GET['link'])) {
        $id_usuario = $_GET['id_usuario'];
        $id_estacionamiento = $_GET['id_estacionamiento'];
        $link_foto = $_GET['link'];
    } else {
        $id_usuario = '';
        $id_estacionamiento = '';
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
    $stmt = $dbh->prepare("SELECT * FROM tabla_estacionamientos WHERE id_estacionamiento='$id_estacionamiento' ");
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
    //echo $id_region."";
    //echo $id_ciudad;

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
    <form name="form1" action="editar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <input type="hidden" name="link_foto" value="<?php echo $link_foto; ?>">
        <input type="hidden" name="id_estacionamiento" value="<?php echo $id_estacionamiento; ?>">

        <div class="fs-2 mb-1 mt"><i class="fa-solid fa-warehouse fa-beat-fade"></i> EDITAR ESTACIONAMIENTO</div>
        <div class="container_r_estacionamiento mt">

            <div class="row">
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="id_region">Región</label>
                            <select class="form-select" aria-label="Default select example" name='id_region' id="id_region" onchange="marcarCiudad(this.value,'<?php echo $id_usuario; ?>','<?php echo $id_estacionamiento; ?>','<?php echo $link_foto; ?>')" Required>
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
                            function marcarCiudad(region, id_usuario, id_estacionamiento, link_foto) {
                                // alert("Hola");
                                var region = region;
                                var id_usuario = id_usuario;
                                var id_estacionamiento = id_estacionamiento;
                                var link_foto = link_foto;
                                if (region != "" && id_usuario != "" && id_estacionamiento != "" && link_foto != "") {
                                    window.location.href = "editarestacionamiento.php?id_usuario=" + id_usuario + "&region=" + region + "&id_estacionamiento=" + id_estacionamiento + "&link=" + link_foto;
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

                            <select class="form-select" aria-label="Default select example" name='id_ciudad' id="id_ciudad" onchange="marcarComuna(this.value,'<?php echo $id_usuario; ?>','<?php echo $region; ?>','<?php echo $id_estacionamiento; ?>','<?php echo $link_foto; ?>')" Required>
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
                            function marcarComuna(ciudad, id_usuario, region, id_estacionamiento, link_foto) {
                                // alert("Hola");
                                var region = region;
                                var id_usuario = id_usuario;
                                var ciudad = ciudad;
                                var link_foto = link_foto;
                                var id_estacionamiento = id_estacionamiento;
                                if (region != "" && id_usuario != "" && ciudad != "" && id_estacionamiento != "" && link_foto != "") {
                                    window.location.href = "editarEstacionamiento.php?id_usuario=" + id_usuario + "&region=" + region + "&ciudad=" + ciudad + "&id_estacionamiento=" + id_estacionamiento + "&link=" + link_foto;
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
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresar Ubicación" value="<?php echo $arrayDatos[0]['ubicacion']; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
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
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresar Título" value="<?php echo $arrayDatos[0]['titulo']; ?>" onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
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
                            <label for="montoArriendo">Monto Arriendo x Día</label>
                            <input type="text" class="form-control" id="montoArriendo" name="montoArriendo" value="<?php echo $arrayDatos[0]['montoArriendo']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" Required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="montoArriendo2">Monto Arriendo x Hora</label>
                            <input type="text" class="form-control" id="montoArriendo2" name="montoArriendo2" value="<?php echo $arrayDatos[0]['montoArriendo2']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" Required>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="link_foto">Subir Foto</label>
                            <input type="file" accept="image/*" class="form-control" id="link_foto" name="link_foto">
                            <small>(Opcional)</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-column">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" placeholder="Ingresa Descripción" id="descripcion" name="descripcion" rows="5" cols="30"><?php echo $arrayDatos[0]['descripcion']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success" id="btnIngresarDireccion" name="btnIngresarDireccion ">Guardar Cambios</button>&nbsp;&nbsp;
                <input type="button" class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudEstacionamiento.php?id_usuario=<?php echo $id_usuario; ?>'">
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