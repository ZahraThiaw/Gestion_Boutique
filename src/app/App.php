<?php

namespace App\App;

use App\Core\Config\ConfigurationContainer;
use App\Core\Database\DatabaseInterface;

class App {
    private static $instance;
    private $database;
    private $configContainer;

    private function __construct() {
        $this->configContainer = new ConfigurationContainer(__DIR__ . '/../../config.yaml');
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDatabase(): DatabaseInterface {
        if ($this->database === null) {
            $this->database = $this->configContainer->createDatabaseConnection();
        }
        return $this->database;
    }

    public function getModel($model) {
        $modelClass = "App\\App\\Model\\" . ucfirst($model) . "Model";
        $table = strtolower($model) . 's';
        $entityClass = "App\\App\\Entity\\" . ucfirst($model) . "Entity";

        $instance = $this->createInstance($modelClass, $this->getDatabase(), $table, $entityClass);
        if ($instance === null) {
            throw new \Exception("Model class $modelClass not found");
        }
        return $instance;
    }

    private function createInstance($class, ...$args) {
        if (class_exists($class)) {
            $reflection = new \ReflectionClass($class);
            return $reflection->newInstance(...$args);
        }
        return null;
    }

    public static function notFound() {}

    public function forbidden() {}
}
