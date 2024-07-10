<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;
use App\Core\Validator;

class ClientController extends Controller
{
    private $utilisateurModel;
    private $validator;

    public function __construct() {
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->validator = new Validator();
    }

    public function index() {
        $client = $this->utilisateurModel->find();
    }

    public function saveClient() {
        // Récupérer les données du formulaire
        $data = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'tel' => $_POST['tel'],
            'photo'=>$_POST['photo'],
            'motDePasse'=>"passer123",

        ];

  
        $this->utilisateurModel->save($data);
    }


    public function findBy($telephone, $value) {
        // $clients = $this->utilisateurModel->findBy($telephone, $value);
        // return $clients;
        // var_dump($clients);
        // die();


        
    }
}