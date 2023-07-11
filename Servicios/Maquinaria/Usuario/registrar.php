<?php
include("../../../Header-Footer/header5.php");
?>

<?php

//capturo los datos del formulario
$id_usuario = $_POST["id_usuario"];
$titulo = $_POST["titulo"];
$tipo = $_POST["tipo"];
$ubicacion = $_POST["ubicacion"];
$id_comuna = $_POST["id_comuna"];
$fechaFormulario = $_POST["fecha"];
$bencina = $_POST["bencina"];
$montoArriendo = $_POST["montoArriendo"];
$descripcion = $_POST["descripcion"];

if ($_FILES['link_foto']['type'] == 'image/png' || $_FILES['link_foto']['type'] == 'image/jpeg') {

    //Trabajar links de archivos
    $foto = $_FILES['link_foto']['name'];
    trim($foto);
    $archivoFoto = $_FILES['link_foto']['tmp_name'];
    $fecha = date_create();
    $fecha = date_timestamp_get($fecha);

    $rutaFoto = "../../../Servicios/Maquinaria/Usuario/fotosUsuarios/" . $fecha . $foto;

    $linkFoto = "http://localhost/ProyectoInacap/RentFacil/Servicios/Maquinaria/Usuario/fotosUsuarios/" . $fecha . $foto;
} else {
    $mensaje = "formato_invalido";
    echo '
            <script>
                    window.location="../../../Servicios/Maquinaria/Usuario/registrarMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
}

// realizar la consulta 
if (move_uploaded_file($archivoFoto, $rutaFoto)) {


    // Reemplazar por PDO
    //generamos consulta para actualizar los datos en la base de datos
    $sql = "INSERT INTO tabla_maquinarias (titulo, descripcion ,tipo , fecha, id_usuario, bencina, ubicacion, id_comuna, montoArriendo, link_foto) VALUES
    ( '$titulo ', '$descripcion', '$tipo', '$fechaFormulario', '$id_usuario', '$bencina', '$ubicacion', '$id_comuna', '$montoArriendo', '$linkFoto')";

    //creo variables de resultado 
    if ($dbh->exec($sql)) {
        $mensaje = 'registrado';
        echo '
            <script>
                    window.location="../../../Servicios/Maquinaria/Usuario/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
    } else {
        $mensaje = 'error_registrar';
        echo '
            <script>
                    window.location="../../../Servicios/Maquinaria/Usuario/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
    }
} else {
    //var_dump($_FILES);
    $mensaje = "error_registrar";
    echo $mensaje;
    echo '
            <script>
                    window.location="../../../Servicios/Maquinaria/Usuario/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
            </script>';
}
?>
<br><br>


<br>





<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  -->
</div>

</body>

</html>