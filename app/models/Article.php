<?php

namespace App\models;
use App\core\Database;
use PDO;

class Article{
    private Database $database;
    private PDO $conn;
    private int $id;
    private int $userID ;
    private string $title ;
    private string $description  ;
    private string $category ;

    public function __construct($title,$description,$category)
    {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();
        $this->id = $this->getTheLastArticleID();
        $this->userID = 6;
        $this->title = htmlspecialchars($title);
        $this->description = htmlspecialchars($description);
        $this->category = htmlspecialchars($category);
    }
    public function getConn (){
        return $this->conn;
    }

    public function getTheLastArticleID() : int {
        return 5;
    }

    public function Add(){
        $conn = $this->conn;
        $data = [$this->title,$this->description,$this->category,$this->userID];
        $sql = "INSERT INTO Articles (title, description, category, userID) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute($data);
    }

    public static function get(){
        $instance = new self("","","");
        $conn = $instance->getConn();
        $sql = "SELECT * FROM Articles";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByID($id){
        $instance = new self("","","");
        $conn = $instance->getConn();
        $sql = "SELECT * FROM Articles JOIN Users ON Users.id = Articles.userid WHERE article_id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}