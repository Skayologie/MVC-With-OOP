<?php
namespace App\controllers;

require realpath(__DIR__."/../../vendor/autoload.php");
use App\core\Controller;
use App\core\Router;
use App\core\View;
use App\models\Article;
use App\models\User;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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

        if(isset($_POST["submit"]) && isset($_POST["Email"]) && isset($_POST["password"]) && $_SERVER["REQUEST_METHOD"]=="POST") {
            $User = new User($_POST["Email"],$_POST["password"]);
            $result = $User->login();

            if ($result["status"]){
                $role = $result["role"];
                echo $role;
                if ($role === "user"){
                    header("location:/article");
                }elseif ($role === "admin"){
                    header("Location:/admin/dashboard");
                }
            }else{
                echo $this->twig->render('front/login.twig',[
                    'title' => 'Login',
                    'message'=> $result["message"]
                ]);
            }
        }else{
            $isAuth = $_SESSION["message"]["isAuth"] ?? false;
            if ($isAuth){
                $ArticleCon->index();
            }else{
                echo $this->twig->render('front/login.twig', [
                    'title' => 'Login',
                ]);
            }

        }
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws \Exception
     */
    public function register(){
        $ArticleCon = new ArticleController($this->twig);
        if(isset($_POST["submit"]) && isset($_POST["Email"]) && isset($_POST["password"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
            try{
                $User = new User($_POST["Email"],$_POST["password"],$_POST["username"]);
                $result = $User->register();
                if ($result["status"]){
                    echo $this->twig->render("front/login.twig",[
                        "message"=>$result["message"]
                    ]);
                }else{
                    echo $this->twig->render("front/register.twig",[
                        "message"=>$result["message"]
                    ]);
                }
            }catch (\Exception $e){
                echo $this->twig->render("front/register.twig",[
                    "message"=>$e->getMessage()
                ]);
            }
        }
        else{
            $isAuth = $_SESSION["message"]["isAuth"] ?? false;

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