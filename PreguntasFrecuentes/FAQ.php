<style>
    <?php include("../CSS/FAQ.css"); ?><?php include("../Header-Footer/header7.php"); ?>
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactar RentFaci</title>
</head>

<body>
    <div class="container_faq mb-5">
        <div class="fs-2 mb-5"><i class="fa-solid fa-question fa-beat-fade"></i> PREGUNTAS FRECUENTES</div>
        <div class="row-sm-3">
            <div class="col-sm mb-3">
                <div class="faq-item ">
                    <div class="faq-question">¿Qué es RentFacil?</div>
                    <div class="faq-answer respuestas">
                        RentFacil es una empresa dedicada a facilitar el arriendo de maquinaria ligera,pesada y estacionamientos para el rubro de la construcción,
                        juntando en un mismo lugar arrendadores y arrendatarios en una misma plataforma, en la cual, pueden tanto arrendar como cotizar,
                        ver variedades de maquinarias y contactar usuarios entre sí.
                    </div>
                </div>
            </div>

            <div class="col-sm mb-3">
                <div class="faq-item">
                    <div class="faq-question">¿Cómo funciona RentFacil?</div>
                    <div class="faq-answer respuestas">
                        Para poder utilizar la aplicación, debes crear una cuenta con la cual podras acceder a los distintos servicios disponibles, publicar 
                        tus propias maquinarias y estacionamientos, cobrar por su arriendo, y ver el estado actual de tus servicios. También podras ponerte en contacto
                        los usuarios y con Administradores de RentFacil en cualquier momento ante cualquier inconveniente o duda.
                    </div>
                </div>
            </div>

            <div class="col-sm mb-3">
                <div class="faq-item">
                    <div class="faq-question">¿Cómo puedo ponerme en contacto con RentFacil?</div>
                    <div class="faq-answer respuestas">
                        Para poder contactarnos, puedes utilizar Redes Sociales, llamar por teléfono o enviarnos un mensaje directamente desde la aplicación.
                    </div>
                </div>
            </div>

            <div class="col-sm mb-3">
                <div class="faq-item">
                    <div class="faq-question">¿Qué métodos de pago aceptan en RentFacil?</div>
                    <div class="faq-answer respuestas">
                        Puedes pagar a través de Mercado Pago, en la cual, puedes usar tu Cuenta Mercado Pago, Tarjeta Débito, Tarjeta Crédito.
                    </div>
                </div>
            </div>

            <div class="col-sm mb-3">
                <div class="faq-item">
                    <div class="faq-question">¿Qué hago si pierdo mi contraseña?</div>
                    <div class="faq-answer respuestas">
                        Puedes recuperar tu contraseña marcando la opción Recuperar Contraseña que se encuentra en el Inicio de Sesión. Recibiras un correo con
                        los pasos a seguir para poder recuperar tu Contraseña.
                    </div>
                </div>
            </div>
            
            <div class="col-sm mb-3">
                <div class="faq-item">
                    <div class="faq-question">¿Cómo puedo desbloquear mi cuenta?</div>
                    <div class="faq-answer respuestas">
                        Por motivos de seguridad, la única manera de poder desbloquear tu cuenta, es poniendote en contacto con un Administrador de RentFacil.
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <script>
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach((question) => {
            question.addEventListener('click', () => {

                const answer = question.nextElementSibling;
                const isAnswerVisible = answer.style.display === 'block';

                if (!isAnswerVisible) {
                    answer.style.display = 'block';
                } else {
                    answer.style.display = 'none';
                }
            });
        });
    </script>
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
</body>

<footer>
    <?php include("../Header-Footer/footer.php"); ?>
</footer>

</html>