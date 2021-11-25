<?php

class LoginController
{
    public function tryLogIn()
    {
        if (!isset($_POST['name'])) {
            return true;
        }
        $data = array(
            "name" => $_POST["name"],
            "email" => $_POST["email"]
        );
        $response = UserModel::getUserByLogIn($data);
        if ($response) {
            $this->loginSuccess($response);
        }
        return $response;
    }

    private function loginSuccess($response)
    {
        session_start();
        $_SESSION['registered'] = true;
        $_SESSION['autorized'] = (bool)$response->Enabled;
        $_SESSION['superAdmin'] = SetupModel::isSuperAdmin($response->UserID);
        $_SESSION['adminList'] = SetupModel::getAllSuperAdmin();
        $_SESSION['id'] = $response->UserID;
        UserModel::updateLastAccess($response->UserID);
        header("location:index.php?route=welcome&name=$response->FullName");   
    }
}
