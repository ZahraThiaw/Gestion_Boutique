<?php

namespace App\Core\Database;

use \PDO;
use \PDOException;

class MysqlDatabase implements DatabaseInterface {
    private $pdo;

    public function __construct($dsn, $user, $password) {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            throw new \Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function prepare(string $sql, array $data, string $entityName, bool $single = false) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName);
        return $single ? $stmt->fetch() : $stmt->fetchAll();
    }

    public function query(string $sql, string $entityName, bool $single = false) {
        $stmt = $this->pdo->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName);
        return $single ? $stmt->fetch() : $stmt->fetchAll();
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }


    public function beginTransaction() {
        $this->pdo->beginTransaction();
    }

    public function commit() {
        $this->pdo->commit();
    }

    public function rollback() {
        $this->pdo->rollback();
    }

}
