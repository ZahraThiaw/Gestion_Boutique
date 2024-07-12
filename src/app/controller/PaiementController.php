<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;
use App\Core\Validator;

class PaiementController extends Controller
{
    private $detteModel;
    private $utilisateurModel;
    private $paiementModel;
    private $validator;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->paiementModel = App::getInstance()->getModel("paiement");
        $this->validator = new Validator;
    }

    public function showpaiement() {
        // Récupérer l'ID de la dette à partir du formulaire POST
        $id = $_POST['id'];

        // Recuperer les informations de la dette
        $dette = $this->detteModel->findBy('id', $id);
        //var_dump($dette);

        //Recuperer les informations du client
        $client = $this->utilisateurModel->findBy('id', $dette->utilisateursId);
        //var_dump($client);


        // Vérifier s'il existe des dettes pour ce client
        $paiements = $this->paiementModel->hasMany('dettesId', $id);

        //var_dump($paiements);

        // Passer les données à la vue 'listerdettes.php'
        $this->renderView('listerpaiements', [
            'dette' => $dette,
            'client' => $client,
            'paiements' => $paiements,
        ]);
    }

    public function formaddpaiement() {
        // vérifier si la dette est soldée
        $dette = $this->detteModel->findBy('id', $_POST['id']);
        if ($dette->montant_restant == 0) {
            $this->renderView('listerdettes', ['error' => 'La dette est déjà soldeée.']);
            return;
        }
        $this->renderView('enregistrerpaiement');
    }

    public function addpaiement() {
        $id = $_POST['id'];
        // Recuperer les informations de la dette
        $dette = $this->detteModel->findBy('id', $id);
        //var_dump($dette);

        //Recuperer les informations du client
        $client = $this->utilisateurModel->findBy('id', $dette->utilisateursId);
        //var_dump($client);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'dettesId' => $id,
                'montant' => $_POST['montant'] ?? '',
                'date' => date('Y-m-d H:i:s'),
            ];

            // Valider les données avec le validateur existant dans votre contrôleur
            $this->validator->validate($data, [
                'montant' => ['required' => true, 'numeric' => true, 'min' => 1, 'max' => $dette->montant_restant],
            ]);

            // Gérer les erreurs de validation
            if ($this->validator->hasErrors()) {
                $errors = $this->validator->getErrors();
                $this->renderView('enregistrerpaiement', [
                    'dette' => $dette,
                    'client' => $client,
                    'errors' => $errors
                ]);
                return;
            }

            // Si aucune erreur, sauvegarder les données dans la base de données
            $this->paiementModel->insert($data);

            $this->renderView('enregistrerpaiement', [
                'dette' => $dette,
                'client' => $client,
                'success' => 'Paiement effectué avec succès'
            ]);
            $this->redirect('enregistrerpaiement');
        }
    }

    
}

