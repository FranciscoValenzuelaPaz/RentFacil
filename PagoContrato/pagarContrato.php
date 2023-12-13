<style>
    <?php include("../CSS/pagarContrato.css");?>
</style>

<?php
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\PaymentClient; 
use MercadoPago\Net\MPSearchRequest;
require "vendor/autoload.php";
include("../Header-Footer/header7.php");
include("../encriptarContrasena/encriptarClave.php");

use MercadoPago\MercadoPagoConfig;
// // Agrega credenciales
MercadoPagoConfig::setAccessToken("TEST-6178722545680518-100520-63aab681745be52b205766ade1874662-519253409");
$preference = null;
?>

<body>
    <?php
    if (isset($_GET['id_contrato'])) {
        $id_contrato = $_GET['id_contrato'];
    } else {
        $id_contrato = '';
    }
    if (isset($_GET['id_usuario'])) {
        $id_usuario = $_GET['id_usuario'];
        $id_usuario_original = $desencriptar($id_usuario);
    } else {
        $id_usuario = '';
        $id_usuario_original = '';
    }

?>

<?php
    #TRAER INFO DE MAQUINARIA O ESTACIONAMIENTO
    $stmt = $dbh->prepare("SELECT id_servicio,tipo_servicio,fecha_desde,fecha_hasta,total FROM tabla_contratos WHERE id_contrato='$id_contrato' AND eliminado = FALSE");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()) {
        $id_servicio = $row["id_servicio"];
        $tipo_servicio = $row["tipo_servicio"];
        $fecha_desde = $row["fecha_desde"];
        $fecha_desde = substr($fecha_desde, 0, 10);
        $fecha_hasta = $row["fecha_hasta"];
        $fecha_hasta = substr($fecha_hasta, 0, 10);
        $total = $row['total'];

        // echo $total;
    }

    $bencina = '';
    $arrayServicio = array();
    if ($tipo_servicio == 1) {

        $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias WHERE id_maquinaria='$id_servicio' AND eliminado = FALSE");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
            $arrayServicio[] = $row;
        }

        $titulo = "Maquinaria: " . $arrayServicio[0]['titulo'];
        $descripcion = $arrayServicio[0]['descripcion'];
        $direccion = $arrayServicio[0]['ubicacion'];
        $foto = $arrayServicio[0]['link_foto'];
        $bencina = $arrayServicio[0]['bencina'];
        if ($bencina == 1) {
            $bencina = 'Con Bencina';
        } else {
            $bencina = 'Sin Bencina';
        }
    } else {
        $stmt = $dbh->prepare("SELECT * FROM tabla_estacionamientos WHERE id_estacionamiento='$id_servicio' AND eliminado = FALSE");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
        $stmt->execute();
        // Mostramos los resultados
        while ($row = $stmt->fetch()) {
            $arrayServicio[] = $row;
        }
        $titulo = "Estacionamiento: " . $arrayServicio[0]['titulo'];
        $descripcion = $arrayServicio[0]['descripcion'];
        $foto = $arrayServicio[0]['link_foto'];
        $direccion = $arrayServicio[0]['ubicacion'];
    }
    ?>



    <!-- CREAR COBRO -->
    <?php
     try {
        $client = new PreferenceClient();
        $preference = $client->create([
          "external_reference" => "teste",
          "items"=> array(
            array(
              "id" => "4567",
              "title" => $titulo,
              "description" => $descripcion,
              "quantity" => 1,
              "currency_id" => "CLP",
              "unit_price" => $total
            )
            ), 
            "back_urls" => array(
                "success" => "https://localhost/ProyectoInacap/RentFacil/PagoContrato/aprobado.php?id_usuario=".$id_usuario." &id_contrato=".$id_contrato,
                "failure" => "https://localhost/ProyectoInacap/RentFacil/PagoContrato/rechazado.php?id_usuario=".$id_usuario." &id_contrato=".$id_contrato
            )     
        ]);
    
        // echo $preference->id;
        $preferenceId = $preference->id;   #ID DE COMPRA 
        // El código para continuar con el flujo normal después de crear la preferencia
    } catch (Exception $e) {
        // Maneja cualquier excepción que pueda ocurrir
        echo 'Error: ' . $e->getMessage();
        
        // Puedes personalizar el manejo de excepciones según tus necesidades.
        $preferenceId = "";   #ID DE COMPRA 

    }

    
    
   
    ?>
    <div class="jumbotron fondojumbotron">
        <div class="contenidoJumbotron">
            <h1 class="display-4"><?php echo $titulo ?></h1>
            <p class="lead"><?php echo $descripcion; ?></p>
            <div class="foto"><img src="<?php echo $foto;  ?>" alt="imagenProducto"></div>
            <hr class="my-4">
            <p>
            <ul>
                <li>
                    <b>Dirección: </b>
                    <?php echo $direccion; ?>
                </li>
                <li>
                    <b>Monto Arriendo: </b>$
                    <?php echo $total; ?>
                </li>
                <li>
                    <b>Fecha Desde: </b>
                    <?php echo $fecha_desde; ?>
                </li>
                <li>
                    <b>Fecha Hasta: </b>
                    <?php echo $fecha_hasta; ?>
                </li>
                <?php if ($bencina != '') { ?>
                    <li>
                        <b>Bencina: <?php echo $bencina; ?> </b>
                    </li>
                <?php } ?>
            </ul>
            </p>
            <div id="wallet_container"></div>
        </div>
    </div>
</body>

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      -->

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('TEST-e0f48a9b-472f-4915-a086-4bad6cfbd101');
    const bricksBuilder = mp.bricks();

    mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "<?php echo $preferenceId; ?>",
            redirectMode: "modal"
        },
    });
</script>



</div>

</html>