<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;
use App\Core\Validator;

class BoutiquierController extends Controller {
    private $utilisateurModel;
    private $validator;

    public function __construct() {
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->validator = new Validator();
    }

    public function index() {
        $boutiquier = $this->utilisateurModel->all();
        $this->renderView('boutiquier', ['boutiquier' => $boutiquier]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rules = [
                'nom' => 'required',
                'prenom' => 'required',
                'email' => 'required|email',
                'motDePasse' => 'required'
            ];

            if ($this->validator->validate($_POST, $rules)) {
                $this->utilisateurModel->save($_POST);
                $this->redirect('/boutiquier');
            } else {
                $errors = $this->validator->getErrors();
                $this->renderView('boutiquier/create', ['errors' => $errors]);
            }
        } else {
            $this->renderView('boutiquier/create');
        }
    }
}
