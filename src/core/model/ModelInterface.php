<?php
namespace App\Core\Model;

interface ModelInterface
{
    public function findBy($column, $value);

    public function query(string $sql, bool $single = false);
    public function hasMany($foreignKey, $value, $status = null);
    public function belongsTo($foreignKey, $value);
    public function belongsToMany($pivotTable, $foreignKey, $value, $relatedTable, $pivotForeignKey) ;

    public function save(array $data);
    public static function update($database, $table, $data, $id) ;
    public function delete($id);
    public function setDatabase($database);
}