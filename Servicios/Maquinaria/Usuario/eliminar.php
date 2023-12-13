<style>
        <?php include("../../../CSS/crudMaquinariasFormulario.css"); ?><?php include("../../../Header-Footer/header5.php"); ?>
</style>
<html>

<body>

        <?php
        if (isset($_GET['id_usuario']) && isset($_GET['id_maquinaria']) && isset($_GET['link'])) {
                $id_usuario = $_GET['id_usuario'];
                $id_maquinaria = $_GET['id_maquinaria'];
                $link_foto = $_GET['link'];
        } else {
                $id_usuario = '';
                $id_maquinaria = '';
                $link_foto = '';
        }

        $mensaje = '';

        //var_dump($_GET);

        $resultado = $dbh->exec("DELETE FROM tabla_maquinarias WHERE id_maquinaria='$id_maquinaria'");
        if ($resultado == 1) {

                //Eliminacion de archivos existentes
                //obtener link consultando a la base 
                $linkFoto = $link_foto;
                $linkFotoArray = explode("/", $linkFoto);
                for ($i = 0; $i < count($linkFotoArray); ($i++)) {
                        $archivoFoto = $linkFotoArray[$i];
                }

                $archivoFoto = "../../../Servicios/Maquinaria/Usuario/fotosUsuarios/" . $archivoFoto;
                //elimino el archivo original 
                //echo $archivo;
                unlink($archivoFoto);

                $mensaje = 'eliminado';
                echo '
             <script>
                     window.location="../../../Servicios/Maquinaria/Usuario/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
        } else {
                $mensaje = 'error_eliminar';
                echo '
             <script>
                     window.location="../../../Servicios/Maquinaria/Usuario/crudMaquinaria.php?id_usuario=' . $id_usuario . '&mensaje=' . $mensaje . '";
             </script>';
        }
        ?>
</body>

</html>