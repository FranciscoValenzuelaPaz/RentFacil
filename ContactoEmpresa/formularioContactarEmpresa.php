<style>
    <?php include("../CSS/contactarEmpresa.css"); ?><?php include("../Header-Footer/header7.php"); ?>
</style>
<?php
include("../encriptarContrasena/encriptarClave.php");

if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    $id_usuario_original = $desencriptar($id_usuario);
    $stmt = $dbh->prepare("SELECT * FROM tabla_usuario WHERE id_usuario='$id_usuario_original'");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()) {

        $nombre_completo = $row["nombre"] . " " . $row["apellido"];
        $telefono = $row["telefono"];
        $apellido = $row["apellido"];
        $correo = $row["email"];
    }
} else {
    $id_usuario = '';
}
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactar RentFaci</title>
</head>

<body>
    <script>
        var mensaje = "<?php echo $mensaje; ?>";
        if (mensaje == "enviado") {
            // Swal.fire({
            //     html: `
            //         <p style="text-align:justify;">Mensaje Enviado con éxito</p>
            //         `,
            // });
            alert("Mensaje Enviado con éxito")

        }
        if (mensaje == "error_enviar") {
            // Swal.fire({
            //     html: `
            //                  <p style="text-align:justify;">Error al enviar el Mensaje, vuelve a intentarlo.</p>
            //                  `,
            // });
            alert("Error al enviar el Mensaje, vuelve a intentarlo.")
        }
    </script>

    <div class="form-container mb-5">
        <form name="form1" action="enviarMensaje.php" method="POST">
            <div class="fs-2 mb-5"><i class="fa-solid fa-address-book fa-beat-fade"></i> CONTACTA CON RENTFACIL</div>
            <input class="input" type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <input class="input" type="hidden" name="nombre" value="<?php echo $nombre_completo; ?>">
            <input class="input" type="hidden" name="telefono" value="<?php echo $telefono; ?>">
            <input class="input" type="hidden" name="correo" value="<?php echo $correo; ?>">

            <div class="form-group mb-4">
                <label for="asunto">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Ingresa el Asunto" Required>
            </div>
            <div class="form-group mb-1">
                <label for="mensaje">Mensaje</label>
                <textarea class="form-control" placeholder="Ingresa Mensaje" id="mensaje" name="mensaje" rows="10" cols="50" Required></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3" id="btnEnviarConsulta" name="btnEnviarConsulta">Enviar Consulta</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>

<footer>
    <?php include("../Header-Footer/footer.php"); ?>
</footer>
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      -->

</html>