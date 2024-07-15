<?php

namespace App\Core\Config;

use Symfony\Component\Yaml\Yaml;
use App\Core\Database\DatabaseInterface;
use App\Core\Database\MysqlDatabase;
use App\Core\File\FilesInterface;
use App\Core\File\Files;
use App\Core\Validator\ValidatorInterface;

class ConfigurationContainer {
    private $config;

    public function __construct($configFilePath) {
        $this->config = Yaml::parseFile($configFilePath);
    }

    public function get($key, $default = null) {
        return $this->config[$key] ?? $default;
    }

    public function getDatabaseConfig() {
        return $this->config['database'] ?? [];
    }

    public function createDatabaseConnection(): DatabaseInterface {
        $dbConfig = $this->getDatabaseConfig();

        $driver = $dbConfig['driver'];
        $dsn = $dbConfig['dsn'];
        $user = $dbConfig['user'];
        $password = $dbConfig['password'];

        switch ($driver) {
            case 'mysql':
                return new MysqlDatabase($dsn, $user, $password);
            default:
                throw new \Exception("Unsupported database driver: $driver");
        }
    }

    public function createValidator(): ValidatorInterface {
        $validatorConfig = $this->config['validator'] ?? null;

        if (!$validatorConfig || !isset($validatorConfig['class'])) {
            throw new \Exception("Validator configuration is missing or invalid.");
        }

        $validatorClass = $validatorConfig['class'];
        if (!class_exists($validatorClass)) {
            throw new \Exception("Validator class not found: $validatorClass");
        }

        return new $validatorClass();
    }

    public function createFileHandle(): FilesInterface {
        $fileConfig = $this->config['files'] ?? null;

        if (!$fileConfig || !isset($fileConfig['class'])) {
            throw new \Exception("Files configuration is missing or invalid.");
        }

        $fileHandlerClass = $fileConfig['class'];
        if (!class_exists($fileHandlerClass)) {
            throw new \Exception("FileHandler class not found: $fileHandlerClass");
        }

        return new $fileHandlerClass(
            $fileConfig['imagesTypes'] ?? [],
            $fileConfig['dir'] ?? ''
        );
    }
}
