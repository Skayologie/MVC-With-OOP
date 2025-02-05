<?php

use App\controllers\ArticleController;
use App\controllers\HomeController;
use App\controllers\UserController;
use App\core\Router;
session_start();

require_once "../app/Core/Router.php";
require_once "../app/Core/Controller.php";
require realpath(__DIR__ . "/../vendor/autoload.php");

$router = new Router();
$router->get("/",HomeController::class, "index");
$router->get("/article",ArticleController::class, "index");
$router->get("/article/{id}",ArticleController::class, "index");
$router->post("/article",ArticleController::class, "AddArticle");

$router->get("/login",UserController::class, "login");
$router->get("/register",UserController::class, "register");

$router->post("/register",UserController::class, "register");
$router->post("/login",UserController::class, "login");
$router->get("/logout",UserController::class, "logout");


$router->dispatch();
