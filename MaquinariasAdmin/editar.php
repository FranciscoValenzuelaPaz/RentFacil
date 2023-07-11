<?php
include("../Header-Footer/header4.php");
?>

<?php

//capturo los datos del formulario

$link_foto = $_POST["link_foto"];
$id_maquinaria = $_POST["id_maquinaria"];
$id_usuario = $_POST["id_usuario"];
$usuario = $_POST["usuario"];
$titulo = $_POST["titulo"];
$tipo = $_POST["tipo"];
$ubicacion = $_POST["ubicacion"];
$id_comuna = $_POST["id_comuna"];
$fecha = date("Y-m-d H:i:s");
$bencina = $_POST["bencina"];
$montoArriendo = $_POST["montoArriendo"];
$descripcion = $_POST["descripcion"];
$mensaje = '';

// print_r($_FILES);
// echo "<br>";

if ($_FILES['link_foto']['size'] > 0) { //esto quiere decir que el usuario desea editar la foto

    if ($_FILES['link_foto']['type'] == 'image/png' || $_FILES['link_foto']['type'] == 'image/jpeg') {

        //Eliminacion de archivos existentes
        //obtener link consultando a la base 
        $linkFoto = $link_foto;
        $linkFotoArray = explode("/", $linkFoto);
        for ($i = 0; $i < count($linkFotoArray); ($i++)) {
            $archivoFoto = $linkFotoArray[$i];
        }

        $archivoFoto = "../Servicios/Maquinaria/Usuario/fotosUsuarios/" . $archivoFoto;
        //elimino el archivo original 
        //echo $archivo;
        unlink($archivoFoto);


        //Trabajar links de archivos
        $foto = $_FILES['link_foto']['name'];
        trim($foto);
        $archivoFoto = $_FILES['link_foto']['tmp_name'];
        $fecha = date_create();
        $fecha = date_timestamp_get($fecha);

        $rutaFoto = "../Servicios/Maquinaria/Usuario/fotosUsuarios/" . $fecha . $foto;

        $linkFoto = "http://localhost/ProyectoInacap/RentFacil/Servicios/Maquinaria/Usuario/fotosUsuarios/" . $fecha . $foto;
        if (move_uploaded_file($archivoFoto, $rutaFoto)) {
            $query = $dbh->prepare("UPDATE tabla_maquinarias SET link_foto = ? WHERE id_maquinaria = ?;");
            $resultado = $query->execute([$linkFoto, $id_maquinaria]); # Pasar en el mismo orden de los ?
        }
    } else {
        $mensaje = "formato_invalido";
        echo '
                <script>
                        window.location="../MaquinariasAdmin/editarMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
                </script>';
    }
}


// realizar la consulta 
// 


// Reemplazar por PDO
//generamos consulta para actualizar los datos en la base de datos
$query = $dbh->prepare("UPDATE tabla_maquinarias SET id_usuario = ?, titulo = ?, descripcion = ?, tipo = ?, bencina = ?, ubicacion = ?, id_comuna = ?,
     montoArriendo = ?,fecha_actualizacion = ?,usuario_actualizacion = ? WHERE id_maquinaria = ?");
$resultado = $query->execute([$usuario, $titulo, $descripcion, $tipo, $bencina, $ubicacion, $id_comuna, $montoArriendo,$fecha,$id_usuario, $id_maquinaria]); # Pasar en el mismo orden de los ?
if ($resultado === TRUE) {
    $mensaje = "editado";
    echo '
             <script>
                     window.location="../MaquinariasAdmin/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
} else {
    $mensaje = "error_editar";
    echo '
             <script>
                     window.location="../MaquinariasAdmin/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
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