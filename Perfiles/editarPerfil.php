<?php
include("../Header-Footer/header2.php");
//var_dump($_POST);

if(isset($_POST['btnEditarPerfil'])){
    //capturo los datos del formulario
    $nombre = $_POST['nombre']; 
    $apellido = $_POST['apellido']; 
    $telefono = $_POST['telefono'];   
    $id_usuario = $_POST['id_usuario'];   

    $mensaje = '';
    //generamos consulta para actualizar los datos en la base de datos
    $query = $dbh->prepare("UPDATE tabla_usuario SET nombre = ?, apellido = ?, telefono = ? WHERE id_usuario = ?;");
    $resultado = $query->execute([$nombre, $apellido, $telefono, $id_usuario]); # Pasar en el mismo orden de los ?
    if($resultado === TRUE){
        $mensaje = "actualizado";
        echo '
            <script>
                    window.location="editarPerfilFormulario.php?id_usuario='.$id_usuario.'&mensaje=' . $mensaje . '";
            </script>';
    } 
    else{
        $mensaje = "error_actualizar";
        echo '
            <script>
                    window.location="editarPerfilFormulario.php?id_usuario='.$id_usuario.'&mensaje=' . $mensaje . '";
            </script>';
    } 
}

?>