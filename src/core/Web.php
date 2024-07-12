<?php

use App\Core\Route;

require_once '../helpers/routecallback.php';


// Récupération de l'instance de Route
$route = Route::getInstance();

// Ajout des routes
$route->get('boutiquier', ['controller' => 'BoutiquierController', 'action' => 'index']);
$route->get('login', ['controller' => 'UtilisateurController', 'action' => 'index']);
$route->post('connexion/login', ['controller' => 'UtilisateurController', 'action' => 'login']);
$route->post('clientsave', ['controller' => 'UtilisateurController', 'action' => 'saveClient']);
$route->post('boutiquier', ['controller' => 'UtilisateurController', 'action' => 'searchByPhone']);
$route->post('literdettes',['controller' => 'DetteController', 'action' => 'show']);
$route->post('listerarticles',['controller' => 'ArticleController', 'action' => 'showarticle']);
$route->post('listerpaiements',['controller' => 'PaiementController', 'action' => 'showpaiement']);
$route->post('enregistrerpaiement',['controller' => 'PaiementController', 'action' => 'formaddpaiement']);
$route->post('add',['controller' => 'DetteController', 'action' => 'formadd']);
$route->get('dette/add/', ['controller' => 'ExoController', 'action' => 'store']);
$route->get('dette/add/#id/#date', ['controller' => 'ExoController', 'action' => 'storeparam']);


$route->get('dette/form', function() {
    echo "Bonsoir";
});
$route->get('dette/list', function() {
    view('form'); // Assumes you have a `view` function that renders your views
});
$route->dispatch();
