<style>
  <?php include("../CSS/header2.css"); ?>
</style>

<?php
if (isset($_GET['id_usuario'])) {
  $id_usuario = $_GET['id_usuario'];
} else {
  $id_usuario = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
ini_set("display_errors", 1);
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
include("../ConexionDB/conexion.php");

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Sweet Alert Script -->
  <script src="../js/sweetalert.min.js"></script>
  <!-- Fontawesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>RentFácil</title>
</head>
<style>
  .iconoNav{
    margin-top: 3px !important;
  }
</style>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary fondo" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RentFácil</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="inicioAdminIframe.php?id_usuario=<?php echo $id_usuario; ?>" style="color:white !important;" target="visor"><i class="fa-solid fa-house iconoNav"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../inicioSesion/iniciarSesion.php" style="color:white !important;">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>