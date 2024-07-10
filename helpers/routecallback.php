<?php
function view($path) {
    // Simple implementation of a view function
    include __DIR__ . "/../views/{$path}.html.php";
}
