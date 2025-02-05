<?php
namespace App\core;
require realpath(__DIR__."/../../vendor/autoload.php");

class Controller {
    public function view($view, $data = []) {
        extract($data);
        if (file_exists(__DIR__."/../views/$view.blade.php")){
            require realpath(__DIR__."/../views/$view.blade.php");
        }elseif (file_exists(__DIR__."/../views/$view.php")){
            require realpath(__DIR__."/../views/$view.php");
        }
    }
}