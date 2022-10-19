<?php


class Conexion extends PDO
{

    const HOST = "localhost";
    const NAME_DATA_BASE = "short_url";
    const USER_NAME = "root";
    const PASSWORD = "";

    public function __construct()
    {
        try {
            parent::__construct(
                'mysql:host='.self::HOST.
                ';dbname='.self::NAME_DATA_BASE.
                ';charset=utf8',
                self::USER_NAME,
                self::PASSWORD
            );
            // return $pdo;
        } catch (PDOException $e) {
            echo "Algo fallo en la conexion a la base de datos: ".$e->getMessage();
            exit;
        }
    }

}
