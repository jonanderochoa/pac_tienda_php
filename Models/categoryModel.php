<?php

require_once "db.php";

class CategoryModel {
    
    static public function getAll() {
        $pdo = Connection::connect()->prepare('SELECT * FROM category');
        $pdo->execute();
        return $pdo->fetchAll();
    }
}