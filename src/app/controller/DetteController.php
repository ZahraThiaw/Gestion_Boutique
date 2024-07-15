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
        $perPage = 5;
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

