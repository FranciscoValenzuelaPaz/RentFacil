
<?php
include("../../Header-Footer/header6.php");
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    $email = '';
}
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
} else {
    $mensaje = '';
}


//filtros para busqueda
$buscar1 = '';


if(isset($_POST['btn_filtrar'])){

  if(!empty($_POST['comunas'])){
    $comunas = $_POST['comunas'];
    $buscar1 = "AND id_comuna='$comunas'";
  }

}
//consulta para traer los datos de todas las maquinarias.
$arrayEstacionamiento = array();
$stmt = $dbh->prepare("SELECT * FROM tabla_estacionamientos WHERE 1=1 $buscar1 AND estado=1");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
while ($row = $stmt->fetch()) {
    $arrayEstacionamiento[] = $row;
}
//print_r($arrayMaquinarias);

//arrays para reemplazar ids por nombres
$arrayEstado = array("Dummy", "Disponible", "Arrendado");

?>
<script>
//   var mensaje = "<?php echo $mensaje; ?>";
//   if(mensaje == "max_direcciones"){
//     Swal.fire({
//       html: `
//                     <p style="text-align:justify;">Límite de Direcciones alcanzado. Intenta Editar o Borrar una Dirección</p>
//                     `,
//     });
    
//   }
//   if(mensaje == "registrado"){
//     Swal.fire({
//               html: `
//                     <p style="text-align:justify;">Dirección Registrada con éxito.</p>
//                     `,
//             });
//   }
//   if(mensaje == "error_registrar"){
//     Swal.fire({
//               html: `
//                     <p style="text-align:justify;">Error al Registrar Dirección. Porfavor vuelve a intentarlo.</p>
//                     `,
//             });
//   }
//   if(mensaje == "editado"){
//     Swal.fire({
//               html: `
//                     <p style="text-align:justify;">Dirección editada con éxito.</p>
//                     `,
//             });
//     }
//   if(mensaje == "error_editar"){
//     Swal.fire({
//               html: `
//                     <p style="text-align:justify;">Error al Editar la dirección. Porfavor vuelve a intentarlo.</p>
//                     `,
//             });
//   }
//   if(mensaje == "eliminado"){
//     Swal.fire({
//               html: `
//                     <p style="text-align:justify;">Dirección eliminada con éxito.</p>
//                     `,
//             });
//   }
//   if(mensaje == "error_eliminar"){
//     Swal.fire({
//               html: `
//                     <p style="text-align:justify;">Error al Eliminar la dirección. Porfavor vuelve a intentarlo.</p>
//                     `,
//             });
//   }
  
</script>
<style>
  .filtros{
    width: 900px !important;
    margin-left: 200px !important;
  }
</style>
<br>
<div class="filtros">
<form class="d-flex" role="search" method="POST">
            <div style="margin-top: 5px !important;">Filtros</div>&nbsp;&nbsp;
            <select class="form-select" aria-label="Default select example" name='comunas' id="comunas">
                <option value="" selected>Comunas</option>
                <?php
                $stmt = $dbh->prepare("SELECT * FROM tabla_comunas");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_comuna'] . '">' . $row['nombre_comuna'] . '</option>';
                }
                ?>
            </select>&nbsp;&nbsp;
          
        <button class="btn btn-outline-success" name="btn_filtrar" type="submit">Filtrar</button>&nbsp;&nbsp;
        <button class="btn btn-success" onclick="location='publicacionEstacionamiento.php?email=<?php echo $email ?>'">Refrescar</button>
</form>
</div>
<br>
<?php if(count($arrayEstacionamiento) > 0 ){ foreach ($arrayEstacionamiento as $estacionamiento) {
    //array para traer Region/Ciudad/Comuna 
    $id_comuna = $estacionamiento['id_comuna'];
    $arrayUbicacion = array();
    $stmt = $dbh->prepare("SELECT M.id_comuna,Comuna.nombre_comuna,Ciudad.nombre_ciudad,Region.nombre_region FROM tabla_estacionamientos as M 
    JOIN tabla_comunas as Comuna ON M.id_comuna=Comuna.id_comuna JOIN tabla_ciudades as Ciudad ON Comuna.id_ciudad=Ciudad.id_ciudad JOIN    
    tabla_regiones as Region ON Ciudad.id_region=Region.id_region WHERE M.id_comuna='$id_comuna'");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()) {
        $arrayUbicacion[] = $row;
    }
    foreach ($arrayUbicacion as $ubicacion) {
        $ubicacionFinal = $ubicacion['nombre_region'] . " / " . $ubicacion['nombre_ciudad'] . " / " . $ubicacion['nombre_comuna'];
    }
    ?>
    <style>
      .card{
        width: 900px !important;
        margin-left: 200px !important;
      }
      .caja{
        padding: 16px !important;
      }
      .imagen{
        width: 800px !important;
   
      }
    </style>
    <br>
    <div class="card">
      <div class="jumbotron caja">
        <h1 class="fs-2" style="margin-left: 35px !important;"><?php echo $estacionamiento['titulo']; ?></h1>
        <div class="imagen" style="margin-left: 35px !important;"><img src="<?php echo $estacionamiento['link_foto']; ?>" alt="FotoPublicacion" class="img-fluid"></div>
        <br>
        <p class="lead" style="margin-left: 35px !important;"><?php echo "Descripción: ".$estacionamiento['descripcion']; ?></p>
        <p class="lead" style="margin-left: 35px !important;"><?php echo "Monto Arriendo: $".$estacionamiento['montoArriendo']; ?></p>
        <hr class="my-4">
        <p style="margin-left: 35px !important;">Ubicación: <?php echo $ubicacionFinal." / ".$estacionamiento['ubicacion']; ?></p>
        <p style="margin-left: 35px !important;">Estado: <?php echo $arrayEstado[$estacionamiento['estado']]; ?></p>
        <p style="margin-left: 35px !important;">Fecha de Publicación: <?php echo $estacionamiento['fecha']; ?></p>
        <div class="d-flex">
        <a class="btn btn-success btn-lg" href="#" role="button" style="margin-left: 35px !important;">Cotizar</a>
        <a class="btn btn-success btn-lg" href="#" role="button" style="margin-left: 35px !important;">Contratar</a>
        <?php if ($estacionamiento['correo'] == $email) { ?>
            <a class="btn btn-success btn-lg" href="Usuario/crudestacionamiento.php?email=<?php echo $email; ?>" role="button" style="margin-left: 35px !important;">Editar</a> 
        <?php } ?> 
        </div>
      </div>
    </div>
    <br>

<?php } }else{ echo "<div class='fs-2' style='margin-left: 200px !important;'>No hay Publicaciones</div>"; }?>



<br><br>


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