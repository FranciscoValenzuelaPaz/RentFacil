<?php
 include("../../../Header-Footer/header5.php");

 if(isset($_GET['email']) && isset($_GET['id_maquinaria']) && isset($_GET['link'])){
    $email = $_GET['email'];
    $id_maquinaria = $_GET['id_maquinaria'];
    $link_foto = $_GET['link'];
 }else{
    $email = '';
    $id_maquinaria = '';
    $link_foto = '';
 }

 $mensaje = '';

 //consulta datos del registro de la maquinaria
 $arrayDatos = array();
 $stmt = $dbh->prepare("SELECT * FROM tabla_maquinarias WHERE id_maquinaria='$id_maquinaria' ");
 // Especificamos el fetch mode antes de llamar a fetch()
 $stmt->setFetchMode(PDO::FETCH_ASSOC);
 // Ejecutamos
 $stmt->execute();
 // Mostramos los resultados
 while ($row = $stmt->fetch()){
     $arrayDatos[] = $row;
 }
 //print_r($arrayDatos);
 ?>

<div class="container">
    <br>
    <div class="fs-3">Editar Maquinaria</div>
    <br>
    <form name="form1" action="editar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="link_foto" value="<?php echo $link_foto; ?>">
        <input type="hidden" name="id_maquinaria" value="<?php echo $id_maquinaria; ?>">

        <div class="form-group">
            <label for="titulo">Título</label>
            <br>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresar Título"
              value="<?php echo $arrayDatos[0]['titulo']; ?>"
              onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
        </div>
        <br>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <br>
            <select class="form-select" aria-label="Default select example" name='tipo' id="tipo" Required>
                <option value="" selected>Selecciona un Tipo</option>
                <?php
                $arrayTipos = array("Dummy","Excavadora","Retroexcavadora","Tractor","Cargador Frontal","Pavimentadora","Compactadora","Grua","Hormigonera","Rompepavimientos","Retropala","Generador");
                for($i=1;$i<count($arrayTipos);$i++){
                    echo '<option value="'.$i.'"';
                    if($arrayDatos[0]['tipo'] == $i){
                        echo "selected";
                    }
                    echo '>'.$arrayTipos[$i].'</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <br>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresar Ubicación"
            value="<?php echo $arrayDatos[0]['ubicacion']; ?>"
                onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
        </div>
        <br>
        <div class="form-group">
            <label for="id_comuna">Comuna</label>
            <br>
            <select class="form-select" aria-label="Default select example" name='id_comuna' id="id_comuna" Required>
                <option value="" selected>Selecciona una Comuna</option>
                <?php
                $stmt = $dbh->prepare("SELECT * FROM tabla_comunas");
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                $stmt->execute();
                // Mostramos los resultados
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_comuna'] . '"';
                    if($arrayDatos[0]['id_comuna'] == $row['id_comuna']){
                        echo "selected";
                    }
                    echo '>' . $row['nombre_comuna'] . '</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="bencina">Combustible</label>
            <br>
            <select class="form-select" aria-label="Default select example" name='bencina' id="bencina" Required>
                <option value="" selected>Selecciona Con/Sin Combustible</option>
                <?php
                $arrayBencina = array("Dummy","Con Combustible","Sin Combustible");
                for($i=1;$i<count($arrayBencina);$i++){
                    echo '<option value="'.$i.'"';
                    if($arrayDatos[0]['bencina'] == $i){
                        echo "selected";
                    }
                    echo '>'.$arrayBencina[$i].'</option>';
                }
                
                ?>
            
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="montoArriendo">Monto Arriendo</label>
            <br>
            <input type="text" class="form-control" id="montoArriendo" name="montoArriendo" value="<?php echo $arrayDatos[0]['montoArriendo']; ?>"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57"  Required>
        </div>
        <br>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" placeholder="Ingresa Descripción" id="descripcion" name="descripcion" rows="10" cols="50"><?php echo $arrayDatos[0]['descripcion']; ?></textarea>
            
        </div>
        <br>
        <div class="form-group">
            <label for="link_foto">Subir Foto</label>
            <br>
            <input type="file" class="form-control" id="link_foto" name="link_foto">
            <small>(Opcional)</small>
        </div>
        
        <br>
        <div class="d-flex">
        <button type="submit" class="btn btn-success" id="btnIngresarDireccion" name="btnIngresarDireccion">Guardar Cambios</button>&nbsp;&nbsp;
        <input type="button"  class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudMaquinaria.php?email=<?php echo $email;?>'">
        </div>
    </form>




    <br><br>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->

</div>
</body>

</html>