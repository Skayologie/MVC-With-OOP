<?php
namespace App\controllers;
require realpath(__DIR__."/../../vendor/autoload.php");

use App\core\Controller;
use App\core\Router;
use Twig\Environment;


class HomeController extends Controller
{
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function index() {
        $isAuth = $_SESSION["message"]["isAuth"] ?? false;

        $username = $_SESSION["message"]["username"] ?? "Not found" ;
        $email = $_SESSION["message"]["email"] ?? "Not found" ;
        echo $this->twig->render('front/home.twig', [
            'title' => 'Welcome',
            'content' => 'Hello World!',
            'isAuth'=>$isAuth,
            "username"=>$username,
            "email"=>$email
        ]);
    }
}