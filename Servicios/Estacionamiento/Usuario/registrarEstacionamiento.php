<?php
    include("../../../Header-Footer/header5.php");
?>
<?php

if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    $email = "";
}

?>
<div class="container">
    <br>
    <div class="fs-3">Ingresar Estacionamiento</div>
    <br>
    <form name="form1" action="registrar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="email" value="<?php echo $email; ?>">

        <div class="form-group">
            <label for="titulo">Título</label>
            <br>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresar Título"
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
                    echo '<option value="' . $row['id_comuna'] . '">' . $row['nombre_comuna'] . '</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <br>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingresar Ubicación"
                onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 ||
              event.charCode == 209 || event.charCode == 241 || event.charCode == 193 || event.charCode == 201 || event.charCode == 205 ||
              event.charCode == 211 || event.charCode == 218 || event.charCode == 225 || event.charCode == 233 || event.charCode == 237 || 
              event.charCode == 243 || event.charCode == 250 || event.charCode == 32 || event.charCode >= 48 &&
              event.charCode <= 57" Required>
        </div>
        <br>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <br>
            <input type="date" class="form-control" id="fecha" name="fecha"  Required>
        </div>
        <br>
        <div class="form-group">
            <label for="montoArriendo">Monto Arriendo</label>
            <br>
            <input type="text" class="form-control" id="montoArriendo" name="montoArriendo"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57"  Required>
        </div>
        <br>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" placeholder="Ingresa Descripción" id="descripcion" name="descripcion" rows="10" cols="50"></textarea>
            
        </div>
        <br>
        <div class="form-group">
            <label for="link_foto">Subir Foto</label>
            <br>
            <input type="file" class="form-control" id="link_foto" name="link_foto" required>
        </div>
        
        <br>
        <div class="d-flex">
        <button type="submit" class="btn btn-success" id="btnIngresarDireccion" name="btnIngresarDireccion">Ingresar</button>&nbsp;&nbsp;
        <input type="button"  class="btn btn-secondary" name="cancelar" value="Cancelar" onclick="location.href='crudEstacionamiento.php?email=<?php echo $email;?>'">
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