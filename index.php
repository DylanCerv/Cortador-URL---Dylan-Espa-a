<?php
    session_start();
//  echo $_SERVER['HTTP_HOST'].'<br>';
//  echo $_SERVER['SERVER_PORT'].'<br>';
//  echo $_SERVER['REQUEST_URI'].'<br>';
//  echo $_SERVER['PHP_SELF'].'<br>';
//  echo $_SERVER['REQUEST_URI'].'<br>';

 $url = explode('/',$_SERVER['REQUEST_URI']);
//  var_dump($url[2]);
 if ($url[2] != ''){
    
    include_once "src/connection/connection.php";

    $pdo = new Conexion();

    $query = "SELECT * FROM short WHERE url_key = :urlkey";

    $sql = $pdo->prepare($query);
    $sql->bindValue(':urlkey', $url[2]);
    $sql->execute();

    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $data = $sql->fetchAll();
    // var_dump(empty( $data));
    if (!empty($data)) {
        // var_dump($data);
        // var_dump($data[0]['url_key'] == $randomString);

        header('LOCATION: '.$data[0]['original']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short URL</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="form">
        <form action="./src/app.php" method="post">
            <label for="nameWS">Nomre del Sitio Web</label>
            <input type="text" name="nameWS" id="nameWS">

            <label for="urlOriginal">URL Original</label>
            <input type="text" name="urlOriginal" id="urlOriginal">

            <button type="submit">Acortar</button>
        </form>
    </div>
    <?php
        if (!empty($_SESSION["name_WS"]) &&
            !empty($_SESSION["original"]) &&
            !empty($_SESSION["url_key"]) ){
    ?>
            <div class="table">
                <table class="">
                    <tr>
                        <th>Nombre</th>
                        <th>Original</th>
                        <th>Short</th>
                    </tr>
                    <tr>
                        <td><?= $_SESSION["name_WS"] ?></td>
                        <td><a href="<?= $_SESSION["original"] ?>"><?= $_SESSION["original"] ?></a></td>
                        <td> <a href="<?= $_SESSION["url_key"] ?>"><?= $_SESSION["url_key"] ?></a></td>
                    </tr>
                </table>
            </div>
    <?php
        }
    ?>
</body>
</html>