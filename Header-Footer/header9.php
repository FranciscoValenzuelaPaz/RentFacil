<style>
  <?php include("../CSS/header.css"); ?>
</style>


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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.css" rel="stylesheet">
</head>

<div class="container">
  <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary fondo" data-bs-theme="dark">
    <div class="container-fluid">
      <title>RentFácil</title>
      <a class="navbar-brand" href="../inicioHome/inicio.php?id_usuario=<?php echo $id_usuario; ?>">RentFácil</a>
      <div class="botones">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Usuario
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../Perfiles/editarPerfilFormulario.php?id_usuario=<?php echo $id_usuario; ?>">Editar Perfil / Direcciones </a></li>
                <li><a class="dropdown-item" href="../Servicios/Maquinaria/Usuario/crudMaquinaria.php?id_usuario=<?php echo $id_usuario; ?>">Ver Maquinaria</a></li>
                <li><a class="dropdown-item" href="../Servicios/Estacionamiento/Usuario/crudEstacionamiento.php?id_usuario=<?php echo $id_usuario; ?>">Ver Estacionamientos</a></li>
                <li><a class="dropdown-item" href="../Servicios/Estados/estadoServicios.php?id_usuario=<?php echo $id_usuario; ?>">Estado</a></li>
                <li><a class="dropdown-item" href="../inicioSesion/iniciarSesion.php">Cerrar Sesión</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Servicios
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../Servicios/Maquinaria/publicacionMaquinaria.php?id_usuario=<?php echo $id_usuario; ?>">Maquinarias</a></li>
                <li><a class="dropdown-item" href="../Servicios/Estacionamiento/publicacionEstacionamiento.php?id_usuario=<?php echo $id_usuario; ?>">Estacionamientos</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../acerca/quienesSomos.php?id_usuario=<?php echo $id_usuario; ?>">Nosotros</a>
            <li class="nav-item dropdown">
            <li class="nav-item">
              <a class="nav-link" href="../ContactoEmpresa/formularioContactarEmpresa.php?id_usuario=<?php echo $id_usuario; ?>">Contáctanos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../PreguntasFrecuentes/FAQ.php?id_usuario=<?php echo $id_usuario; ?>">FAQ</a>
            </li>
        </div>
        </ul>
      </div>
      </ul>
    </div>
  </nav>
</div>


</html>












</body>

<html>