<?php

namespace App\Core\Database;

interface DatabaseInterface {
    public function prepare(string $sql, array $data, string $entityName, bool $single = false);
    public function query(string $sql, string $entityName, bool $single = false);
}
