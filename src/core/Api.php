<?php

use App\Core\Route;

// Récupération de l'instance de Route
$route = Route::getInstance();

// Ajout des routes
$route->get('api/dette/list', ['controller' => 'ExoController', 'action' => 'show']);

$route->dispatch();

