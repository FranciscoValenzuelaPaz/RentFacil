<?php
// Con un array de opciones
$user = 'uznevbi6qxpqywcp';
$password = 'fmCnGz3BdgpPG5PtxIqd';
try {
    $dsn = "mysql:host=bwb63xon9zosqjnbjiqe-mysql.services.clever-cloud.com;dbname=bwb63xon9zosqjnbjiqe";
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
    echo $e->getMessage();
}
?>
<?php
// Con un el método PDO::setAttribute
try {
    $dsn = "mysql:host=bwb63xon9zosqjnbjiqe-mysql.services.clever-cloud.com;dbname=bwb63xon9zosqjnbjiqe";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo $e->getMessage();
}
if (!$dbh) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}
?>