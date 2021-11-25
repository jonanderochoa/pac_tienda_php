<?php

class RouteModel
{
    const ROUTE_BASE = 'Views/modules/';

    static public function getRoute($page)
    {
        if ($page == "login" || $page == "edit" || $page == "delete" || $page == "welcome" || $page == "products" || $page == "product" || $page == "users"  || $page == "user" || $page == "exit") {
            return self::ROUTE_BASE . $page . ".php";          
        } else {
            return self::ROUTE_BASE . "login.php";
        } 
    }
}
