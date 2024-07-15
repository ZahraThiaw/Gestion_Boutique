<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;
use App\Core\Recu\Recu;
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


    public function addpaiement()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $detteId = $_POST['id'];

            // Récupérer la dette à partir de l'ID
            $dette = $this->detteModel->findBy('id', $detteId);
            
            // Récupérer les informations du client
            $client = $this->utilisateurModel->findBy('id', $dette->utilisateursId);

            if ($dette && isset($_POST['montant']) && is_numeric($_POST['montant'])) {
                $montant = floatval($_POST['montant']);

                if ($dette->montant_restant > 0) {
                    if ($montant > 0 && $montant <= $dette->montant_restant) {
                        // Enregistrer le paiement
                        $paiementData = [
                            'date' => date('Y-m-d'),
                            'montant' => $montant,
                            'dettesId' => $detteId
                        ];
                        $this->paiementModel->save($paiementData);

                         // Mettre à jour le montant versé de la dette
                        $this->detteModel->updateMontantVerse($dette->id, $montant);

                        // Mettre à jour le montant restant de la dette
                        $this->detteModel->updateMontantRestant($dette->id, $montant);

                        // Générer un reçu de paiement
                        $recu = new  Recu();
                        $data = [
                            'montant' => $montant,
                            'date' => date('Y-m-d'),
                            'nom' => $client->nom,
                            'prenom' => $client->prenom,
                            'telephone' => $client->telephone,
                            'montant_restant' => $dette->montant_restant,
                        ];
                        $recu->generateRecu($data, '../public/recus');

                        $successMessage = "Le paiement a été effectué avec succès.";
                        //$this->redirect("listerdettes?success={$successMessage}");
                        $this->renderView('enregistrerpaiement', compact('dette', 'client', 'successMessage'));
                    }
                     else {
                        $error = "Le montant doit être inférieur ou égal au montant restant.";
                        $this->renderView('enregistrerpaiement', compact('dette', 'client', 'error'));
                    }
                } else {
                    $error = "Cette dette est déjà soldée.";
                    $this->renderView('listerdettes', compact('dette', 'client', 'error'));
                }
            }

            // Afficher la vue avec les erreurs si nécessaire
            $this->renderView('enregistrerpaiement', compact('dette', 'client'));
        } else {
            $error = "Méthode non autorisée.";
            $this->renderView('listerdettes', compact('error'));
        }
    }


//     public function addpaiement()
// {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $detteId = $_POST['id'];

//         // Récupérer la dette à partir de l'ID
//         $dette = $this->detteModel->findBy('id', $detteId);
        
//         // Récupérer les informations du client
//         $client = $this->utilisateurModel->findBy('id', $dette->utilisateursId);

//         if ($dette && isset($_POST['montant']) && is_numeric($_POST['montant'])) {
//             $montant = floatval($_POST['montant']);

//             if ($dette->montant_restant > 0) {
//                 if ($montant > 0 && $montant <= $dette->montant_restant) {
//                     // Enregistrer le paiement
//                     $paiementData = [
//                         'date' => date('Y-m-d'),
//                         'montant' => $montant,
//                         'dettesId' => $detteId
//                     ];
//                     $this->paiementModel->save($paiementData);

//                     // Mettre à jour le montant versé de la dette
//                     $this->detteModel->updateMontantVerse($dette->id, $montant);

//                     // Mettre à jour le montant restant de la dette
//                     $this->detteModel->updateMontantRestant($dette->id, $montant);

//                     // Ajouter le message de succès dans la session
//                     $this->session->set('success', "Le paiement a été effectué avec succès.");

//                     // Rediriger vers la page enregistrerdette
//                     $this->redirect("enregistrerdette?id={$dette->utilisateursId}");
//                 } else {
//                     $error = "Le montant doit être inférieur ou égal au montant restant.";
//                 }
//             } else {
//                 $error = "Cette dette est déjà soldée.";
//             }
//         }

//         // Afficher la vue avec les erreurs si nécessaire
//         $this->renderView('enregistrerpaiement', compact('dette', 'client'));
//     } else {
//         $error = "Méthode non autorisée.";
//         $this->renderView('listerdettes', compact('error'));
//     }
// }


    
}

