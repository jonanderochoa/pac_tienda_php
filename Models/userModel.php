<?php

require_once "db.php";

class UserModel {

    static public function getUserByLogIn($data) {
        $sql = "SELECT * FROM user where FullName = :name && Email = :email";
        $pdo = Connection::connect()->prepare($sql);
        $pdo->bindParam(':name', $data["name"], PDO::PARAM_STR);
        $pdo->bindParam(':email', $data["email"], PDO::PARAM_STR);
        $pdo->execute();
        return $pdo->fetch();
    } 

    static public function get($id) {
        $pdo = Connection::connect()->prepare("SELECT * FROM user where UserID = :id");
        $pdo->bindParam(':id', $id, PDO::PARAM_INT);
        $pdo->execute();
        return $pdo->fetch();
    }

    static public function getAll($order, $pagina) {
        $sql = 'SELECT * FROM user';
        if(isset($order)) {
            $sql .= ' ORDER BY ' . $order;
        }
        $sql .= ' LIMIT ' . (($pagina - 1) * 10) . ", 10";
        $pdo = Connection::connect()->prepare($sql);
        $pdo->execute();
        return $pdo->fetchAll();
    }

    static public function create($user) {
        $sql = 'INSERT INTO user(FullName, Password, Email, LastAccess, Enabled) VALUES (:name, :pass, :email, :lastAccess, :enabled)';
        $pdo = Connection::connect()->prepare($sql);
        $pdo->bindParam(':name', $user['name'], PDO::PARAM_STR);
        $pdo->bindParam(':pass', $user['pass'], PDO::PARAM_STR);
        $pdo->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $pdo->bindParam(':lastAccess', $user['lastAccess'], PDO::PARAM_STR);
        $pdo->bindParam(':enabled', $user['enabled'], PDO::PARAM_BOOL);
        return $pdo->execute();
    }

    static public function update($id, $user) {
        $sql = 'UPDATE user SET FullName = :name, Password = :pass, Email = :email, LastAccess = :lastAccess, Enabled = :enabled where UserID = :id';
        $pdo = Connection::connect()->prepare($sql);
        $pdo->bindParam(':id', $id, PDO::PARAM_INT);
        $pdo->bindParam(':name', $user['name'], PDO::PARAM_STR);
        $pdo->bindParam(':pass', $user['pass'], PDO::PARAM_STR);
        $pdo->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $pdo->bindParam(':lastAccess', $user['lastAccess'], PDO::PARAM_STR);
        $pdo->bindParam(':enabled', $user['enabled'], PDO::PARAM_BOOL);
        return $pdo->execute();
    }

    static public function updateLastAccess($id) {
        $sql = 'UPDATE user SET LastAccess = :lastAccess where UserID = :id';
        $pdo = Connection::connect()->prepare($sql);
        $pdo->bindParam(':id', $id, PDO::PARAM_INT);
        $pdo->bindParam(':lastAccess', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        return $pdo->execute();
    }

    static public function delete($id) {
        $pdo = Connection::connect()->prepare('DELETE FROM user WHERE UserId = :id');
        $pdo->bindParam(':id', $id, PDO::PARAM_INT);
        return $pdo->execute();
    }

    static public function countUsers() {
        $sql = 'SELECT count(*) as num_users FROM user';
        $pdo = Connection::connect()->query($sql);
        return $pdo->fetchColumn();
    }
}