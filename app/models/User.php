<?php

namespace App\models;


use App\core\Database;
use App\core\Session;
use App\core\Validator;
use PDO;

class User
{
    private Database $database;
    private PDO $conn;
    private $id;
    private $username;
    private $email;
    private $password;


    public function __construct($email, $password, $username="Skayologie"){
        $this->database = new Database();
        if (Validator::validate_email($email) && Validator::validate_username($username) && Validator::validate_password($password)){
            $this->email = $email;
            $this->password = $password;
            $this->username = $username;
        }else{
            header("Location: " . $_SERVER['HTTP_REFERER']);
            throw new \Exception("Data not Valid !");
        }
    }

    public function register(){
        try {
            $this->conn = $this->database->getConnection();
            $conn = $this->conn;
            $hashedPassword = password_hash($this->password,PASSWORD_BCRYPT);
            $sql = "INSERT INTO Users (username, email, password) VALUES('$this->username','$this->email','$hashedPassword')";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()){
                $_SESSION["message"] = [
                    "status"=>true,
                    "message"=>"Registred successfully !"
                ];
            }else{
                $_SESSION["message"] = [
                    "status"=>false,
                    "message"=>"Register Failed !"
                ];
            }

        }catch (\PDOException $e){
            $_SESSION["message"] = [
                "status"=>false,
                "message"=>"Data not correct or empty !"
            ];
        }
        return $_SESSION["message"] ;
    }

    public function login(){
        try {
            $this->conn = $this->database->getConnection();
            $conn = $this->conn;
            $sql = "SELECT * FROM Users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->email]);
            if ($stmt->rowCount() > 0){
                $result = $stmt->fetch();
                if (password_verify($this->password,$result["password"])){ // Thats mean is the password is correct
                    Session::set("message",[
                        "status"=>true,
                        "message"=>"Logged successfully !",
                        "isAuth"=>true,
                        "username"=>$result["username"],
                        "email"=>$result["email"],
                        "role"=>$result["role"],
                    ]);
                }else{ // Thats mean is the password is incorrect
                    Session::set("message",[
                        "status"=>false,
                        "message"=>"Sorry But The Password is incorrect !!",
                        "isAuth"=>false
                    ]);
                }
            }else{// Thats mean is the email is not exist
                Session::set("message",[
                    "status"=>false,
                    "message"=>"Sorry But there is no account with this Email .",
                    "isAuth"=>false
                ]);
            }
        }catch (\PDOException $e){
            Session::set("message",[
                "status"=>false,
                "message"=>"DB Problems",
                "isAuth"=>false
            ]);
        }
        return Session::get("message");
    }

    public static function logout(){
        Session::destroy();
    }

}
