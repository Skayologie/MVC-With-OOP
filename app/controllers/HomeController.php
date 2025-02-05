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
        $isAuth = false;
        if (isset($_SESSION["message"]["isAuth"])){
            $isAuth = true;
        }
        $username =  isset($_SESSION["message"]) ? $_SESSION["message"]["username"] : "Not found" ;
        $email = isset($_SESSION["message"]) ?? $_SESSION["message"]["email"] ;
        echo $this->twig->render('front/home.twig', [
            'title' => 'Welcome',
            'content' => 'Hello World!',
            'isAuth'=>$isAuth,
            "username"=>$username,
            "email"=>$email
        ]);
    }
}