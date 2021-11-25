<?php

class ProductController
{

    public function createOrUpdate()
    {
        if(!isset($_POST['name'])){
            return;
        }
        $data = array(
            "name" => $_POST["name"],
            "categoryID" => (int)$_POST["categoryID"],
            "cost" => (double)$_POST["cost"],
            "price" => (double)$_POST["price"]
        );

        if (isset($_GET['id'])) {
            $response = ProductModel::update($_GET['id'], $data);
        } else {
            $response = ProductModel::create($data);
        }
        if ($response) {
            header("location:index.php?route=products");
        } else {
            echo "error";
        }
    }

    public function get($id) {
        return ProductModel::get($id);
    }

    public function loadTable()
    {
        $pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;
        $order = null;
        if(isset($_GET['order'])) {
            $order = $_GET['order'];
        }
        $products = ProductModel::getAll($order, $pagina);
        foreach ($products as $p) {
            $prod = '<tr>
            <td>' . $p->productID . '</td>
            <td>' . $p->Name . '</td>
            <td>' . $p->Cost . '</td>
            <td>' . $p->Price . '</td>
            <td>' . $p->category . '</td>';
            if($_SESSION['superAdmin']){
                $prod .= '<td><a href="index.php?route=product&action=edit&id=' . $p->productID . '"><button type="button" class="btn btn-primary">Editar</button></a></td>
                            <td><a href="index.php?route=products&id=' . $p->productID . '"><button type="button" class="btn btn-danger">Borrar</button></a></td>';
            }
            '</tr>';
            echo $prod;
        }
    }

    public function getNumProducts() {
        return ProductModel::countProducts();
    }

    public function delete($id)
    {
        return ProductModel::delete($id);
    }
}
