<?php

namespace App\Core;

use App\Core\Pagination\PaginationInterface;

class Pagination implements PaginationInterface {
    private $currentPage;
    private $total;
    private $perPage;

    public function __construct($currentPage, $total, $perPage) {
        $this->currentPage = $currentPage;
        $this->total = $total;
        $this->perPage = $perPage;
    }

    public function getTotalPages() {
        return ceil($this->total / $this->perPage);
    }

    public function render() {
        $totalPages = $this->getTotalPages();
        $output = '<div class="flex justify-center mt-4">';
        
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = $i == $this->currentPage ? 'bg-blue-500 text-white' : 'bg-white text-blue-500';
            $output .= "<a href='?page=$i' class='border px-3 py-1 $active'>$i</a>";
        }
        
        $output .= '</div>';
        return $output;
    }
}
