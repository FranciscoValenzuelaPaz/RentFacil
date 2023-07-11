<style>
    <?php include("../CSS/inicioAdmin.css"); ?>
</style>
<?php
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
} else {
    $id_usuario = '';
}
?>
<html>

<body class="body">
    <div class="container">
        <?php include("../Header-Footer/header8.php"); ?>
        <div class="fs-3 titulo">Bienvenido a RentFacil. Cuenta de Administrador</div><br><br>
        <iframe src="inicioAdminIframe.php?id_usuario=<?php echo $id_usuario; ?>" name="visor" frameborder="0" width="1295" height="700"></iframe>
        <?php include("../Header-Footer/footer.php"); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>