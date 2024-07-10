<?php
namespace App\App;

use App\Core\Database\MysqlDatabase;
use Dotenv\Dotenv;

class App{
    private static $instance;
    private $database;
    
    public function __construct() {}

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDatabase(){
        if ($this->database === null) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            $this->database = new MysqlDatabase($_ENV['DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        }
        return $this->database;
    }

    public function getModel($model) {
        $modelClass = "App\\App\\Model\\" . ucfirst($model) . "Model";
        $table = strtolower($model) . 's'; // Utilisation de la convention de nommage pour les tables
        $entityClass = "App\\App\\Entity\\" . ucfirst($model) . "Entity";

        if (class_exists($modelClass)) {
            return new $modelClass($this->getDatabase(), $table, $entityClass);
        }

        throw new \Exception("Model class $modelClass not found");
    }

    public static function notFound() {}

    public function forbidden() {}
}
