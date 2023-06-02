
<?php
    include("../../../Header-Footer/header5.php");
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
?>
<script>
  var mensaje = "<?php echo $mensaje; ?>";
  
  if(mensaje == "registrado"){
    Swal.fire({
              html: `
                    <p style="text-align:justify;">Maquinaria Registrada con éxito.</p>
                    `,
            });
  }
  if(mensaje == "error_registrar"){
    Swal.fire({
              html: `
                    <p style="text-align:justify;">Error al Registrar Maquinaria. Porfavor vuelve a intentarlo.</p>
                    `,
            });
  }
  if(mensaje == "editado"){
    Swal.fire({
              html: `
                    <p style="text-align:justify;">Maquinaria editada con éxito.</p>
                    `,
            });
    }
  if(mensaje == "error_editar"){
    Swal.fire({
              html: `
                    <p style="text-align:justify;">Error al Editar la Maquinaria. Porfavor vuelve a intentarlo.</p>
                    `,
            });
  }
  if(mensaje == "eliminado"){
    Swal.fire({
              html: `
                    <p style="text-align:justify;">Maquinaria eliminada con éxito.</p>
                    `,
            });
  }
  if(mensaje == "error_eliminar"){
    Swal.fire({
              html: `
                    <p style="text-align:justify;">Error al Eliminar la Maquinaria. Porfavor vuelve a intentarlo.</p>
                    `,
            });
  }
  
</script>
<br>
<div class="fs-3">Registrar Maquinaria</div>
    <br>
    <button type="button" class="btn btn-success" onclick="location='registrarMaquinaria.php?email=<?php echo $email ?>'" >Registrar</button>
    <br><br>
    
    <?php 
    //array con informacion de las direcciones del usuario
    $arrayMaquinarias = array();
    $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias as D JOIN tabla_comunas as Cu ON D.id_comuna = Cu.id_comuna WHERE D.correo='$email'");
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    while ($row = $stmt->fetch()){
        $arrayMaquinarias[] = $row;
    }
    //print_r($arrayMaquinarias);

    


    //arrays para reemplazar numeros por datos en la tabla
    $arrayTipoMaquinaria = array("Dummy","Excavadora","Retroexcavadora","Tractor","Cargador Frontal","Pavimentadora","Compactadora","Grua","Hormigonera","Rompepavimientos","Retropala","Generador");
    $arrayBencina = array('Dummy',"Con Combustible","Sin Combustible");
    $arrayEstado = array('Dummy',"Disponible","Arrendado");
    ?>

 <?php if(!empty($arrayMaquinarias)){ ?>   
  <div class="fs-3">Lista de Maquinarias</div>
    <br>
    <button class="btn btn-success" onclick="location='crudMaquinaria.php?email=<?php echo $email ?>'">Actualizar Registros</button>
    <br><br>  
<div class="table-responsive">
<table class="table table-hover">
  <thead>
    <tr>
        <th scope="col">Título</th>
        <th scope="col">Tipo</th>
        <th scope="col">Fecha de Publicación</th>
        <th scope="col">Bencina</th>
        <th scope="col">Ubicación</th>
        <th scope="col">Región/Ciudad/Comuna</th>
        <th scope="col">Monto de Arriendo</th>
        <th scope="col">Foto</th>
        <th scope="col">Descripción</th>
        <th scope="col">Estado</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
  <?php foreach($arrayMaquinarias as $maquinaria){ ?> <!--obtengo la fila del resultado-->  
  </thead>
  <style>
    .descripcion{
      height: 120px !important;
      width: 280px !important;
    }
    .celda{
      width: 140px !important;
    }
  </style>
  <tbody class="table-group-divider">
    <tr>
        <td><div class="celda"><?php echo $maquinaria['titulo']; ?></div> </td> <!--retorno de mysql-->
        <td><div class=""><?php echo $arrayTipoMaquinaria[$maquinaria['tipo']]; ?></div> </td>
        <td><div class=""><?php echo $maquinaria['fecha']; ?></div> </td>
        <td><div class="celda"><?php echo $arrayBencina[$maquinaria['bencina']]; ?> </div></td>
        <td><div class="celda"><?php echo $maquinaria['ubicacion']; ?></div> </td>
        <td>
          <div class="celda">
            <?php 
            //array para traer Region/Ciudad/Comuna 
            $id_comuna = $maquinaria['id_comuna'];
            $arrayUbicacion = array();
            $stmt = $dbh->prepare("SELECT M.id_comuna,Comuna.nombre_comuna,Ciudad.nombre_ciudad,Region.nombre_region FROM tabla_maquinarias as M 
            JOIN tabla_comunas as Comuna ON M.id_comuna=Comuna.id_comuna JOIN tabla_ciudades as Ciudad ON Comuna.id_ciudad=Ciudad.id_ciudad JOIN
            tabla_regiones as Region ON Ciudad.id_region=Region.id_region WHERE M.id_comuna='$id_comuna'");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            while ($row = $stmt->fetch()){
                $arrayUbicacion[] = $row;
            }
            foreach($arrayUbicacion as $ubicacion){
              $ubicacionFinal = $ubicacion['nombre_region']." / ".$ubicacion['nombre_ciudad']." / ".$ubicacion['nombre_comuna'];
            }
            echo $ubicacionFinal; 
            ?>
          </div> 
        </td>
        <td><div class=""><?php echo "$".$maquinaria['montoArriendo']; ?></div> </td>
        <td><a href="<?php echo $maquinaria['link_foto']; ?>" target="_blank"><img src="<?php echo $maquinaria['link_foto']; ?>" alt="fotoMaquinariaUsuario" width="150" height="120"></a></td>
        <td><div class="descripcion overflow-y-scroll"><?php echo $maquinaria['descripcion']; ?></div> </td>
        <td><div><?php echo $arrayEstado[$maquinaria['estado']]; ?> </td>
        <td><a href="editarMaquinaria.php?email=<?php echo $email; ?>&id_maquinaria=<?php echo $maquinaria['id_maquinaria'];?>&link=<?php echo $maquinaria['link_foto']; ?>"><button class="btn btn-success">Editar</button></a></td>
        <td><a href="eliminar.php?email=<?php echo $email; ?>&id_maquinaria=<?php echo $maquinaria['id_maquinaria']; ?>&link=<?php echo $maquinaria['link_foto']; ?>"><button class="btn btn-danger" onclick="return confirm('¿Está Segur@ de eliminar este Registro?')">Eliminar</button></a></td>  
    </tr>
     
  </tbody>
  <?php }?>
</table>
</div> 
<?php }else{ ?>
  <div class="fs-3">No se encuentrar Maquinarias Registradas</div>

<?php }?>
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
  </body>
</html>