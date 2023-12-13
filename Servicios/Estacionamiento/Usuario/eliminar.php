<style>
        <?php include("../../../CSS/crudEstacionamientosFormulario.css"); ?><?php include("../../../Header-Footer/header5.php"); ?>
</style>

<html>

        <?php
        

        if (isset($_GET['id_usuario']) && isset($_GET['id_estacionamiento']) && isset($_GET['link'])) {
                $id_usuario = $_GET['id_usuario'];
                $id_estacionamiento = $_GET['id_estacionamiento'];
                $link_foto = $_GET['link'];
        } else {
                $id_usuario = '';
                $id_estacionamiento = '';
                $link_foto = '';
        }

        $mensaje = '';

        //var_dump($_GET);

        $resultado = $dbh->exec("DELETE FROM tabla_estacionamientos WHERE id_estacionamiento='$id_estacionamiento'");
        if ($resultado == 1) {

                //Eliminacion de archivos existentes
                //obtener link consultando a la base 
                $linkFoto = $link_foto;
                $linkFotoArray = explode("/", $linkFoto);
                for ($i = 0; $i < count($linkFotoArray); ($i++)) {
                        $archivoFoto = $linkFotoArray[$i];
                }

                $archivoFoto = "../../../Servicios/Estacionamiento/Usuario/fotosUsuarios/" . $archivoFoto;
                //elimino el archivo original 
                //echo $archivo;
                unlink($archivoFoto);

                $mensaje = 'eliminado';
                echo '
             <script>
                     window.location="../../../Servicios/Estacionamiento/Usuario/crudEstacionamiento.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
        } else {
                $mensaje = 'error_eliminar';
                echo '
             <script>
                     window.location="../../../Servicios/Estacionamiento/Usuario/crudEstacionamiento.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
        }
        ?>

</html>