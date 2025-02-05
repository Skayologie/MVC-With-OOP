<?php
namespace App\controllers;
require realpath(__DIR__."/../../vendor/autoload.php");
use App\core\Controller;
use App\core\Router;
use App\models\Article;
use Twig\Environment;


class ArticleController extends Controller
{
    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function index($id="",$message = null) {
        $isAuth = false;
        if (isset($_SESSION["message"]["isAuth"])){
            $isAuth = true;
        }
        if ($id >= 0){
            echo $this->twig->render('front/articleDetails.twig', [
                'title' => 'Articles',
                'articleDetails' => Article::getByID($id),
                'isAuth' => $isAuth
            ]);
        }else{
            if (isset($_SESSION["message"]["isAuth"]) && $_SESSION["message"]["isAuth"] ){
                echo $this->twig->render('front/article.twig', [
                    'title' => 'Welcome',
                    'articles' => Article::get(),
                    'isAuth' => $isAuth,
                    'msg' => $message
                ]);
            }else{
                echo $this->twig->render('front/404.twig', []);
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