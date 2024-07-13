<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class DetteController extends Controller
{
    private $detteModel;
    private $utilisateurModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
    }

    // public function show() {
    //     // Récupérer l'ID du client à partir du formulaire POST
    //     $id = $_POST['id'];

    //     // Récupérer les informations du client
    //     $client = $this->utilisateurModel->findBy('id', $id);

    //     // Vérifier s'il existe des dettes pour ce client
    //     $dettes = $this->detteModel->hasMany('utilisateursId', $id);

    //     // Passer les données à la vue 'listerdettes.php'
    //     $this->renderView('listerdettes', [
    //         'client' => $client,
    //         'dettes' => $dettes,
    //     ]);
    // }


    // public function show() {
    //     // Récupérer l'ID du client à partir du formulaire POST
    //     $id = $_POST['id'];
    
    //     // Récupérer les informations du client
    //     $client = $this->utilisateurModel->findBy('id', $id);
    
    //     // Récupérer le statut de filtrage
    //     $status = $_GET['status'] ?? null;
    
    //     // Récupérer les dettes filtrées (non soldées par défaut)
    //     $dettes = $this->detteModel->hasMany('utilisateursId', $id, $status);
    
    //     // Pagination
    //     $currentPage = $_GET['page'] ?? 1;
    //     $perPage = 5;
    //     $total = count($dettes);
    //     $offset = ($currentPage - 1) * $perPage;
    //     $dettesPaginated = array_slice($dettes, $offset, $perPage);
    
    //     // Passer les données à la vue 'listerdettes.php'
    //     $this->renderView('listerdettes', [
    //         'client' => $client,
    //         'dettes' => $dettesPaginated,
    //         'total' => $total,
    //         'perPage' => $perPage,
    //         'currentPage' => $currentPage,
    //     ]);
    // }
    

    // public function show() {
    //     // Récupérer l'ID du client à partir du formulaire POST
    //     $id = $_POST['id'];
    
    //     // Récupérer les informations du client
    //     $client = $this->utilisateurModel->findBy('id', $id);
    
    //     // Récupérer les filtres de statut et de date depuis POST
    //     $status = $_POST['status'] ?? null;
    //     $date = $_POST['date'] ?? null;
    
    //     // Récupérer les dettes filtrées
    //     $dettes = $this->detteModel->hasMany('utilisateursId', $id, $status, $date);
    
    //     // Pagination
    //     $currentPage = $_GET['page'] ?? 1;
    //     $perPage = 5;
    //     $total = count($dettes);
    //     $offset = ($currentPage - 1) * $perPage;
    //     $dettesPaginated = array_slice($dettes, $offset, $perPage);
    
    //     // Passer les données à la vue 'listerdettes.php'
    //     $this->renderView('listerdettes', [
    //         'client' => $client,
    //         'dettes' => $dettesPaginated,
    //         'total' => $total,
    //         'perPage' => $perPage,
    //         'currentPage' => $currentPage,
    //         'status' => $status,
    //         'date' => $date, // Ajoutez la date pour garder l'état du filtrage
    //     ]);
    // }


    // public function show() {
    //     $clientId = $_POST['id'];
    
    //     // Récupérer les informations du client
    //     $client = $this->utilisateurModel->findBy('id', $clientId);
    
    //     // Récupérer les données de filtrage
    //     $status = isset($_POST['status']) ? $_POST['status'] : null;
    //     $date = isset($_POST['date']) ? $_POST['date'] : null;
    
    //     // Récupérer les dettes
    //     $dettes = $this->detteModel->hasMany('utilisateursId', $clientId, $status);
    
    //     if ($date) {
    //         // Filtrer par date si spécifié
    //         $dettes = array_filter($dettes, function($dette) use ($date) {
    //             return $dette->date === $date;
    //         });
    //     }
    
    //     // Passer les données à la vue
    //     $this->renderView('listerdettes', [
    //         'client' => $client,
    //         'dettes' => $dettes,
    //     ]);
    // }

    public function show() {
        $clientId = $_POST['id'];
    
        // Récupérer les informations du client
        $client = $this->utilisateurModel->findBy('id', $clientId);
    
        // Récupérer les données de filtrage
        $status = isset($_POST['status']) ? $_POST['status'] : null;
        $date = isset($_POST['date']) ? $_POST['date'] : null;
    
        // Récupérer les dettes
        $dettes = $this->detteModel->hasMany('utilisateursId', $clientId, $status);
    
        // Filtrer par date si spécifié
        if ($date) {
            $dettes = array_filter($dettes, function($dette) use ($date) {
                return $dette->date === $date;
            });
        }
    
        // Pagination
        $currentPage = $_POST['page'] ?? 1;
        $perPage = 1;
        $total = count($dettes);
        $offset = ($currentPage - 1) * $perPage;
        $dettesPaginated = array_slice($dettes, $offset, $perPage);
    
        // Passer les données à la vue
        $this->renderView('listerdettes', [
            'client' => $client,
            'dettes' => $dettesPaginated,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'status' => $status,
            'date' => $date,
        ]);
    }
    
    
    
    
}

