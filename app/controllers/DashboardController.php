<?php
namespace App\controllers;
require realpath(__DIR__."/../../vendor/autoload.php");
use App\core\Controller;
use App\core\Router;
use App\models\Article;
use Twig\Environment;

class DashboardController{
    private Environment $twig;
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function index() {
        $this->twig->render("back/dashboard.twig");
    }

}