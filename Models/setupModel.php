<?php

require_once "db.php";

class SetupModel {

    static public function isSuperAdmin($id) {
        $pdo = Connection::connect()->prepare('SELECT * FROM setup where SuperAdmin = ' . $id);
        $pdo->execute();
        return $pdo->fetch() != null;
    }

    static public function getAllSuperAdmin() {
        $pdo = Connection::connect()->prepare('SELECT SuperAdmin FROM setup');
        $pdo->execute();
        return $pdo->fetchAll();
    }
}