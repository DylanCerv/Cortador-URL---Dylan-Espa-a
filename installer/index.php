<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instancia de pruebas</title>
    <!-- Bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->

<style>
    .caja {
        border: #f2f2f210 solid 1px;
        overflow: hidden;
        margin: 50px;
        padding: 20px;
    }
</style>
</head>
<body class="bg-black text-light">
<!-- Aca dentro va codigo PHP -->
<div class="caja"><?php 
// Informacion del host
$host = 'localhost';
$host_user = 'root';
$host_pass = '';
$host_db = 'short_url';
// Archivo SQL que vamos a importar
$queries = explode(';', file_get_contents('short_url.sql'));
$enlace = mysqli_connect($host, $host_user, $host_pass);
if (!$enlace) {
    die('No pudo conectarse: ' . mysql_error());
}
if (mysqli_query($enlace, 'DROP DATABASE short_url')) {
    echo "La base de datos short_url se borró correctamente <br><hr>";
} 
if (mysqli_query($enlace, "CREATE DATABASE $host_db")) {
    echo "La base de datos short_url se creó correctamente <br><hr>";
} 
// Conectamos a la base de datos creada
$connection = new mysqli($host, $host_user, $host_pass, $host_db);
if($connection->connect_error){
    echo '<center>Hay un problema en el servidor.</center>';
    die();
}
$count = 1;
foreach($queries as $query){
  if($query != ''){
      $res = $connection->query($query) ? ' [OK] ' : ' [WARNING] ';
        echo "$count $res<br>$query<hr>";
  }
  $count ++;
}


?></div> 
</body>
</html>