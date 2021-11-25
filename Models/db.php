<?php

require_once "./config/dev.php";

class Connection {

    public static function connect()
    {
        try {
            $conn = new PDO(DSN, USER, PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $conn; 
    }
}
