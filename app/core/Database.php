<?php
namespace App\core;
use Dotenv\Dotenv;
use PDO;

require realpath(__DIR__."/../../vendor/autoload.php");
//make sure to give the right path to the autoloader file.

// Load .env file from the root of your project
$dotenv = Dotenv::createImmutable(__DIR__."/../../");
$dotenv->load();


class Database{
    public function getConnection()
    {
        $DB_SERVER   = $_ENV["HOST"];
        $DB_USERNAME = $_ENV["USERNAME"];
        $DB_PASSWORD = $_ENV["PASSWORD"];
        $DB_NAME     = $_ENV["DB"];
        $source = "pgsql:host=$DB_SERVER;port=5432;dbname=$DB_NAME;user=$DB_USERNAME;password=$DB_PASSWORD";
        return new PDO($source);
    }
}
