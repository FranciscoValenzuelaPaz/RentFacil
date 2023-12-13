<style>
    <?php include("../CSS/formularioCotizacion.css"); ?><?php include("../Header-Footer/header7.php"); ?>
</style>

<html>

<body>
    <?php
    if (isset($_GET['id_usuario']) && isset($_GET['id_maquinaria']) && isset($_GET['tipo_servicio'])) {
        $id_usuario = $_GET['id_usuario'];
        $id_maquinaria = $_GET['id_maquinaria'];
        $tipo_servicio = $_GET['tipo_servicio'];
    } else {
        $id_usuario = '';
        $id_maquinaria = '';
        $tipo_servicio = '';
    }


    // echo "id_usuario: " . $id_usuario . "<br>";
    // echo "id_maquinaria: " . $id_maquinaria . "<br>";
    // echo "tipo_servicio: " . $tipo_servicio . "<br>";


    //consulta para traer información respecto a la publicación

    $arrayInfoPublicacion = array();
    $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias as M JOIN tabla_usuario as U ON M.id_usuario=U.id_usuario WHERE M.id_maquinaria='$id_maquinaria'");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()) {
        $arrayInfoPublicacion[] = $row;
    }

    $id_servicio = $id_maquinaria;
    $id_usuario_publicacion = $arrayInfoPublicacion[0]['id_usuario'];
    $monto = $arrayInfoPublicacion[0]['montoArriendo'];

    // echo $id_usuario_publicacion . "<br>";
    // echo $monto;

    ?>
    <form name="form1" class="fondo" action="enviarCotizacion.php" method="POST">
        <div class="fs-3 titulo mb-5">COTIZACIÓN DE SERVICIO DE MAQUINARIAS</div>
        <input class="input" type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <input class="input" type="hidden" name="id_usuario_publicacion" value="<?php echo $id_usuario_publicacion; ?>">
        <input class="input" type="hidden" name="id_servicio" value="<?php echo $id_servicio; ?>">
        <input class="input" type="hidden" name="monto" value="<?php echo $monto; ?>">
        <input class="input" type="hidden" name="tipo_servicio" value="<?php echo $tipo_servicio; ?>">

        <div class="form-group mb-4">
            <label for="fecha_desde">Fecha Desde</label>
            <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" Required>
        </div>
        <div class="form-group">
            <label for="fecha_hasta">Fecha Hasta</label>
            <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" Required>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success" id="btnEnviarCotizacion" name="btnEnviarCotizacion">Enviar Cotización</button>&nbsp;
            <input type="button" class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='../Servicios/Maquinaria/publicacionMaquinaria.php?id_usuario=<?php echo $id_usuario; ?>'">
        </div>
    </form>
    </div>


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
</div>
</body>

</html>