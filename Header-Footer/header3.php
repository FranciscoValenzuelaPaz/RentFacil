<!DOCTYPE html>
<html lang="en">
<style>
  <?php include("../CSS/header.css"); ?>
</style>

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
  <title>Rent Fácil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="../js/sweetalert.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>
</head>

<body>
  <div class="container">
    <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary fondo2" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">RentFácil</a>
       
       
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <div class="botones">
              <button class="btn btn-trasparent" onclick="location='../inicioSesion/iniciarSesion.php'">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
              </button>
              <button class="btn btn-trasparent" onclick="location='../registro/registrarUsuario.php'">
                <i class="fas fa-user-plus"></i> Registrarse
              </button>
            </div>
          </ul>
        </div>
        </ul>
      </div>
  </div>
  </nav>
  </div>
</body>

</html>