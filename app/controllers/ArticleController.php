<?php
namespace App\controllers;
require realpath(__DIR__."/../../vendor/autoload.php");
use App\core\Controller;
use App\core\Router;
use App\core\Session;
use App\models\Article;
use Twig\Environment;


class ArticleController extends Controller
{
    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function index($id="",$message = null) {
        $isAuth = $_SESSION["message"]["isAuth"] ?? false;

        if ($id >= 0){
            if ($isAuth) {
                echo $this->twig->render('front/articleDetails.twig', [
                    'title' => 'Articles',
                    'articleDetails' => Article::getByID($id),
                    'isAuth' => $isAuth
                ]);
            }else{
                echo $this->twig->render('front/404.twig', []);
            }
        }else{
            if ($isAuth){
                echo $this->twig->render('front/article.twig', [
                    'title' => 'Welcome',
                    'articles' => Article::get(),
                    'isAuth' => $isAuth,
                    'msg' => $message,
                    'role'=> Session::get("message")["role"]
                ]);
            }else{
                echo $this->twig->render('front/404.twig', [
                    'role'=> Session::get("message")["role"]
                ]);
            }

        }
    }
    public function AddArticle(){
        $title = $_POST["title"];
        $description = $_POST["description"];
        $category = $_POST["categorie"];
        $article = new Article($title,$description,$category);
        $result = $article->Add();
        $Message = [];
        if ($result){
            $Message = [
              "msg"=>"All Good Bro , Don't Worry"
            ];
        }
        $this->index($Message);
    }


}