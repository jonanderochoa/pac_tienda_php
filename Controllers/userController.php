<?php

class UserController {

    public function get($id) {
        return UserModel::get($id);
    }

    public function loadTable()
    {
        $pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;
        $order = null;
        if(isset($_GET['order'])) {
            $order = $_GET['order'];
        }
        $users = UserModel::getAll($order, $pagina);
        foreach ($users as $u) {
            $lastAccessDate = date_create($u->LastAccess);
            $formatDate = date_format($lastAccessDate, "d/m/y");
            $isAdmin = array_search($u->UserID, array_column($_SESSION['adminList'], 'SuperAdmin')) !== FALSE;
            $color = $isAdmin  ? "class='table-success'" : "";
            $buttons = $_SESSION['superAdmin'] && $_SESSION['id'] == $u->UserID ? 
            '<td><button type="button" class="btn btn-primary" disabled>Editar</button></td>
            <td><button type="button" class="btn btn-danger" disabled>Borrar</button></td>'
             : 
             '<td><a href="index.php?route=user&action=edit&id=' . $u->UserID  . '"><button type="button" class="btn btn-primary">Editar</button></a></td>
            <td><a href="index.php?route=users&id=' . $u->UserID  . '"><button type="button" class="btn btn-danger">Borrar</button></a></td>';

            echo '<tr '. $color .'>
            <td>' . $u->UserID . '</td>
            <td>' . $u->FullName . '</td>
            <td>' . $u->Email . '</td>
            <td>' . $formatDate . '</td>
            <td>' . $u->Enabled . '</td>'
            . $buttons. '</tr>';
        }
    }

    public function delete($id)
    {
        return UserModel::delete($id);
    }

    public function createOrUpdate()
    {
        if(!isset($_POST['name'])){
            return;
        }
        $data = array(
            "name" => $_POST["name"],
            "pass" => $_POST["pass"],
            "email" => $_POST["email"],
            "lastAccess" => $_POST["lastAccess"],
            "enabled" => isset($_POST["enabled"])
        );

        if (isset($_GET['id'])) {
            $response = UserModel::update($_GET['id'], $data);
        } else {
            $response = UserModel::create($data);
        }
        if ($response) {
            header("location:index.php?route=users");
        } else {
            echo "error";
        }
    }

    public function getNumUsers() {
        return UserModel::countUsers();
    }
}