<style>
    <?php include("../CSS/preContrato.css"); ?><?php include("../Header-Footer/header9.php"); ?>
</style>
<?php
require_once '../SendMail/config.php';
require '../SendMail/vendor/autoload.php';
include("../encriptarContrasena/encriptarClave.php");
?>

<body>
    <?php
    if (isset($_GET['id_cotizacion'])) {
        $id_cotizacion = $_GET['id_cotizacion'];
    } else {
        $id_cotizacion = '';
    }


    if ($id_cotizacion != '') {
        $infoCotizacion = '';
        $stmt = $dbh->prepare("SELECT * FROM tabla_cotizaciones WHERE id_cotizacion='$id_cotizacion'");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
            $infoCotizacion = $row;
        }
        $id_servicio = $infoCotizacion['id_servicio'];

        $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias WHERE id_maquinaria='$id_servicio'");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
            $infoServicio = $row;
        }
    }

    ?>
    <div class="jumbotron fondojumbotron">
        <div class="contenidoJumbotron">
            <h1 class="display-4"><?php echo $infoServicio["titulo"]; ?></h1>
            <p class="lead"><?php echo $infoServicio["descripcion"]; ?></p>
            <hr class="my-4">
            <p>
            <ul>
                <li>
                    <b>Bencina: </b>
                    <?php
                    $bencina = $infoServicio["bencina"];
                    if ($bencina == 1) {
                        echo "Con Bencina";
                    } else {
                        echo "Sin Bencina";
                    }
                    ?>
                </li>
                <li>
                    <b>Dirección: </b>
                    <?php echo $infoServicio["ubicacion"]; ?>
                </li>
                <li>
                    <b>Monto Arriendo: </b>$
                    <?php echo $infoServicio["montoArriendo"]; ?>
                </li>
                <li>
                    <b>Fecha Desde: </b>
                    <?php echo $infoCotizacion["fecha_desde"]; ?>
                </li>
                <li>
                    <b>Fecha Hasta: </b>
                    <?php echo $infoCotizacion["fecha_hasta"]; ?>
                </li>
            </ul>
            </p>
            <p class="lead ctrl">
                <a class="btn btn-success btn-lg" href="../inicioSesion/iniciarSesionCotizacionAContrato.php?id_cotizacion=<?php echo $id_cotizacion; ?>">Contratar</a>
            </p>
        </div>
    </div>
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