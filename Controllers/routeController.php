<?php

class RouteController {

    public function getTemplate() {
        include "Views/template.php";
    }

    public function getRoute() {
        $page = (isset($_GET["route"])) ? $_GET["route"] : "index";
        include RouteModel::getRoute($page);
    }
}