<?php
namespace App\controllers;

require realpath(__DIR__."/../../vendor/autoload.php");
use App\core\Controller;
use App\core\Router;
use App\core\View;
use App\models\Article;
use App\models\User;
use Twig\Environment;

class UserController
{
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function index(){
        $isAuth = false;
        if (isset($_SESSION["Auth"])){
            $isAuth = true;
            echo $this->twig->render('front/article.twig', [
                'title' => 'Welcome',
                'isAuth' => $isAuth
            ]);
        }
        echo $this->twig->render('front/articleDetails.twig', [
            'title' => 'Welcome',
            'isAuth' => $isAuth
        ]);
    }

    public function login(){
        $ArticleCon = new ArticleController($this->twig);
        $DashboardCon = new DashboardController($this->twig);

        if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"]=="POST") {
            $User = new User($_POST["Email"],$_POST["password"]);
            $result = $User->login();

            if ($result["status"]){
                $role = $result["status"];
                if ($role === "user"){
                    echo $this->twig->render('front/article.twig',[
                        'title' => 'Articles',
                    ]);
                }elseif ($role === "admin"){
                    echo $this->twig->render('back/article.twig',[
                        'title' => 'Articles',
                    ]);
                }
            }else{
                echo $this->twig->render('front/login.twig',[
                    'title' => 'Login',
                    'message'=> $result["message"]
                ]);
            }
        }else{
            $isAuth = isset($_SESSION["message"]["isAuth"]) ?? $_SESSION["message"]["isAuth"] ;
            if ($isAuth){
                $ArticleCon->index();

            }else{
                echo $this->twig->render('front/login.twig', [
                    'title' => 'Welcome',
                ]);
            }

        }
    }
    public function register(){
        $ArticleCon = new ArticleController($this->twig);
        if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
            $User = new User($_POST["Email"],$_POST["password"],$_POST["username"]);
            $User->register();
            $msg = $_SESSION["message"];
            if ($msg){

            }else{

            }
        }
        else{
            $isAuth = isset($_SESSION["message"]["isAuth"]) ?? $_SESSION["message"]["isAuth"] ;
            if ($isAuth){
                $ArticleCon->index();
            }else{
                echo $this->twig->render('front/register.twig', [
                    'title' => 'Welcome',
                ]);
            }
        }
    }

    public function logout(){
        User::logout();
        header("Location:/login");
    }
}