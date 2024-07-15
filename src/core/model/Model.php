<?php
namespace App\Core\Model;

use App\App\App;
use App\Core\Database\MysqlDatabase;
use \PDO;
use PDOException;

abstract class Model implements ModelInterface{
    protected $database;
    protected $table;
    protected $entityName; // Propriété pour stocker le nom de la classe

    public function __construct(MysqlDatabase $database, string $table, string $entityName) {
        $this->database = $database;
        $this->table = $table;
        $this->entityName = $entityName;
    }

    // public function all() {
    //     $sql = "SELECT * FROM {$this->table}";
    //     return $this->database->query($sql, $this->entityName);
    // }
    

    public function findBy($column, $value) {
        $sql = "SELECT * FROM " . $this->table . " WHERE $column = :$column";
        $data = [":$column" => $value];
        return $this->database->prepare($sql, $data, $this->entityName, true);
    }

    public function hasMany($foreignKey, $value, $status = null) {
        $sql = "SELECT * FROM " . $this->table . " WHERE $foreignKey = :$foreignKey";
        $data = [":$foreignKey" => $value];
        return $this->database->prepare($sql, $data, $this->entityName, false);
    }

    public function belongsTo($foreignKey, $value) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = (SELECT $foreignKey FROM " . $this->table . " WHERE id = :id)";
        $data = [':id' => $value];
        return $this->database->prepare($sql, $data, $this->entityName, true);
    }
    
    
    public function belongsToMany($pivotTable, $foreignKey, $value, $relatedTable, $pivotForeignKey) {
        $sql = "SELECT * FROM $relatedTable WHERE id IN 
                (SELECT $foreignKey FROM $pivotTable WHERE $pivotForeignKey = :id)";
        $data = [':id' => $value];
        return $this->database->prepare($sql, $data, $this->entityName, false);
    }
    
    

    


    public function query(string $sql, bool $single = false)
    {
        return $this->database->query($sql, $this->entityName, $single);
    }

    /**
     * Exécute une requête personnalisée.
     *
     * @param string $sql La requête SQL à exécuter.
     * @return mixed Les résultats de la requête.
     */
    public function prepare(string $sql, array $data, string $entityName = null, bool $single = false)
    {   
        if($entityName == null){
            $entityName = $this->entityName;
        }

        return $this->database->prepare($sql, $data, $entityName, $single);
    }

    private function buildSetClause(array $data): string
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        return implode(', ', $set);
    }

    private function buildPlaceholders(array $data): string
    {
        return implode(', ', array_fill(0, count($data), '?'));
    }
    

    /**
     * Sauvegarde l'enregistrement actuel.
     *
     * @return bool True si la sauvegarde a réussi, false sinon.
     */
    public function save(array $data)
    {
        if (isset($data['id'])) {
            // Update
            return $this->database->prepare("UPDATE {$this->table} SET " . $this->buildSetClause($data) . " WHERE id = ?", array_values($data), $this->entityName);
        } else {
            // Insert
        
            return $this->database->prepare("INSERT INTO {$this->table} (" . implode(', ', array_keys($data)) . ") VALUES (" . $this->buildPlaceholders($data) . ")", array_values($data), $this->entityName);
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $params = [':id' => $id];
        return $this->database->prepare($sql, $params, $this->entityName);
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

    public static function update($database, $table, $data, $id) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = :$column";
        }
        $setString = implode(", ", $set);
        $sql = "UPDATE $table SET $setString WHERE id = :id";
        $data[':id'] = $id;

        try {
            $stmt = $database->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            // Gérer les erreurs PDO ici
            return false;
        }
    }
}
