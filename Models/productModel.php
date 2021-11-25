<?php

require_once "db.php";

class ProductModel {

    static public function get($id) {
        $pdo = Connection::connect()->prepare("SELECT * FROM product where ProductID = :id");
        $pdo->bindParam(':id', $id, PDO::PARAM_INT);
        $pdo->execute();
        return $pdo->fetch();
    }

    static public function getAll($order, $pagina) {
        $sql = 'SELECT productID, p.Name, Cost, Price, p.CategoryID, c.Name as category 
        FROM product p INNER JOIN category c on p.CategoryID = c.CategoryID';
        if(isset($order)) {
            $sql .= ' ORDER BY ' . $order;
        }
        $sql .= ' LIMIT ' . (($pagina - 1) * 10) . ", 10";
        $pdo = Connection::connect()->prepare($sql);
        $pdo->execute();
        return $pdo->fetchAll();
    }

    static public function countProducts() {
        $sql = 'SELECT count(*) as num_products FROM product';
        $pdo = Connection::connect()->query($sql);
        return $pdo->fetchColumn();
    }

    static public function create($product) {
        $sql = 'INSERT INTO product(name, cost, price, categoryID) VALUES (:nombre, :cost, :price, :categoryID)';
        $pdo = Connection::connect()->prepare($sql);
        $pdo->bindParam(':nombre', $product['name'], PDO::PARAM_STR);
        $pdo->bindParam(':cost', $product['cost'], PDO::PARAM_STR);
        $pdo->bindParam(':price', $product['price'], PDO::PARAM_STR);
        $pdo->bindParam(':categoryID', $product['categoryID'], PDO::PARAM_STR);
        return $pdo->execute();
    }

    static public function update($id, $product) {
        $sql = 'UPDATE product SET Name = :nombre, Cost = :cost, Price = :price, CategoryID = :categoryID  where ProductID = :id';
        $pdo = Connection::connect()->prepare($sql);
        $pdo->bindParam(':id', $id, PDO::PARAM_INT);
        $pdo->bindParam(':nombre', $product['name'], PDO::PARAM_STR);
        $pdo->bindParam(':cost', $product['cost'], PDO::PARAM_STR);
        $pdo->bindParam(':price', $product['price'], PDO::PARAM_STR);
        $pdo->bindParam(':categoryID', $product['categoryID'], PDO::PARAM_STR);
        return $pdo->execute();
    }

    static public function delete($id) {
        $pdo = Connection::connect()->prepare('DELETE FROM product WHERE ProductId = :id');
        $pdo->bindParam(':id', $id, PDO::PARAM_INT);
        return $pdo->execute();
    }
}