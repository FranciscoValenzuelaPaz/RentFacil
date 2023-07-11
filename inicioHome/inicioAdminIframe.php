<style>
    <?php include("../CSS/inicioAdminiFrame.css"); ?>
</style>
<?php
include("../Header-Footer/header4.php");
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
} else {
    $id_usuario = '';
}

?>
<html>

<body>
    <div class="caja">
        <div class="d-flex">
            <ul class="lista list-group list-group-horizontal">
                <li>
                    <form action="../UsuariosAdmin/crudUsuarios.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <button type="submit" class="btn btn-success boton"><i
                                class="fa-solid fa-users icono"></i><br>Usuarios</button>
                    </form>
                </li>
                <li>
                    <form action="../MaquinariasAdmin/crudMaquinaria.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <button type="submit" class="btn btn-success boton"><i
                                class="fa-solid fa-train-tram icono"></i><br>Maquinarias</button>
                    </form>
                </li>
                <li>
                    <form action="../EstacionamientosAdmin/crudEstacionamiento.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <button type="submit" class="btn btn-success boton"><i
                                class="fa-solid fa-car-tunnel icono"></i><br>Estacionamientos</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-flex">
            <ul class="lista list-group list-group-horizontal">
                <li>
                    <form action="../DireccionesAdmin/crudDirecciones.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <button type="submit" class="btn btn-success boton"><i
                                class="fa-solid fa-map-location-dot icono"></i><br>Direcciones</button>
                    </form>
                </li>
                <li>
                    <form action="../ContratosAdmin/crudContratos.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <button type="submit" class="btn btn-success boton"><i
                                class="fa-solid fa-file-signature icono"></i><br>Contratos</button>
                    </form>
                </li>
                <li>
                    <form action="../CotizacionesAdmin/crudCotizaciones.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <button type="submit" class="btn btn-success boton"><i
                                class="fa-solid fa-file-invoice-dollar icono"></i><br>Cotizaciones</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>