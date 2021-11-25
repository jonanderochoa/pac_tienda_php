<?php
// Controllers
require_once "Controllers/routeController.php";
require_once "Controllers/loginController.php";
require_once "Controllers/userController.php";
require_once "Controllers/productController.php";
require_once "Controllers/categoryController.php";

// Models
require_once "Models/routeModel.php";
require_once "Models/userModel.php";
require_once "Models/productModel.php";
require_once "Models/categoryModel.php";
require_once "Models/setupModel.php";

$route = new RouteController();
$route->getTemplate();