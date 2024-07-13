<?php

namespace App\Core\Pagination;

interface PaginationInterface {
    public function getTotalPages();
    public function render();
}
