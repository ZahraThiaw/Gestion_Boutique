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
        // Récupérer l'ID du client à partir du formulaire POST
        $id = $_POST['id'];

        // Récupérer les informations du client
        $client = $this->utilisateurModel->findBy('id', $id);

        // Vérifier s'il existe des dettes pour ce client
        $dettes = $this->detteModel->hasMany('utilisateursId', $id);

        // Passer les données à la vue 'listerdettes.php'
        $this->renderView('listerdettes', [
            'client' => $client,
            'dettes' => $dettes,
        ]);
    }
}

