<?php
session_start();

include_once "connection/connection.php";

$pdo = new Conexion();



function randomString($pdo) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($characters) -1);
        $randomString .= $characters[$index];
    }

    

    $query = "SELECT url_key FROM short WHERE url_key = :urlkey";

    $sql = $pdo->prepare($query);
    $sql->bindValue(':urlkey', $randomString);
    $sql->execute();


    $countStrg = $sql->fetchColumn();

    if ($countStrg > 0) {
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $data = $sql->fetchAll();
        // var_dump($data[0]['url_key']);
        // var_dump($data[0]['url_key'] == $randomString);
    
    
        while ($data[0]['url_key'] == $randomString) {
            $indexCharacters = rand(0, strlen($characters) -1);
            $indexStringRandom = rand(0, strlen($randomString) -1);

            $randomString[$indexStringRandom] = $characters[$indexCharacters];
        }
    
    }

    return $randomString;
}
 




if (!empty( $_POST['urlOriginal']) && !empty( $_POST['nameWS']) ){
// if (empty( $_POST['urlOriginal']) && empty( $_POST['nameWS']) ){
    echo "no vacias";

    $stringKEY = randomString($pdo);
    
    var_dump($stringKEY);

    $query = 'INSERT INTO short (name_web, original, url_key) VALUES (:name_web, :original, :url_key)';

    $sql = $pdo->prepare($query);
    $sql->bindValue(':name_web', $_POST['nameWS']);
    $sql->bindValue(':original', $_POST['urlOriginal']);
    $sql->bindValue(':url_key', $stringKEY);
    $sql->execute();


    $_SESSION["name_WS"] = $_POST['nameWS'];
    $_SESSION["original"] = $_POST['urlOriginal'];
    $_SESSION["url_key"] = $stringKEY;
}

header('LOCATION: ./../');

