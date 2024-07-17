<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class DetteController extends Controller
{
    private $detteModel;
    private $utilisateurModel;
    private $articleModel;
    private $dettearticleModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->articleModel = App::getInstance()->getModel("article");
        $this->dettearticleModel = App::getInstance()->getModel("dettearticle");

        // Initialiser le panier dans la session si ce n'est pas déjà fait
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
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


    public function add() {
        $client = null; 
        $article = null; 
        $error = null; 
    
        // Vérification si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id']; 
            $client = $this->utilisateurModel->findBy('id', $id); 
    
            // Vérification si une référence d'article a été soumise
            if (isset($_POST['reference'])) {
                $reference = $_POST['reference']; 
                $article = $this->articleModel->findBy('reference', $reference); 
    
                // Gestion des erreurs si l'article n'existe pas
                if (!$article) {
                    $error = 'Aucun article n\'est disponible avec cette référence';
                }
            }
    
            // Ajout d'une quantité à l'article si spécifié
            if (isset($_POST['quantite']) && $article) {
                $quantite = $_POST['quantite']; 
                $articleExist = false; // Variable pour vérifier si l'article existe déjà dans le panier
    
                // Vérification si l'article est déjà dans le panier
                foreach ($_SESSION['panier'] as &$item) {
                    if ($item['reference'] === $article->reference) {
                        $item['quantite'] += $quantite; // Mise à jour de la quantité
                        $articleExist = true; // Indication que l'article existe déjà
                        break;
                    }
                }
    
                // Si l'article n'existe pas, ajout au panier
                if (!$articleExist) {
                    $_SESSION['panier'][] = [
                        'id' => $article->id,
                        'reference' => $article->reference,
                        'libelle' => $article->libelle,
                        'prix' => $article->prix,
                        'quantite' => $quantite
                    ];
                }
    
                // Rendu de la vue avec les informations du client et le contenu du panier
                $this->renderView('enregistrerdette', [
                    'client' => $client,
                    'panier' => $_SESSION['panier']
                ]);
                return; // Sortie de la méthode pour éviter d'exécuter le code en dessous
            }
    
            // Traitement de l'enregistrement si le formulaire est soumis pour sauvegarder
            if (isset($_POST['save']) && $_SESSION['panier']) {
                $montant_total = 0;
    
                // Calcul du montant total des articles dans le panier
                foreach ($_SESSION['panier'] as $item) {
                    $montant_total += $item['prix'] * $item['quantite'];
                }
    
                $montant_verse = 0; 
                $montant_restant = $montant_total - $montant_verse; 
    
                // Transaction pour sauvegarder la dette
                $result = $this->detteModel->transaction(function ($detteModel) use ($client, $montant_total, $montant_verse, $montant_restant) {
                    // Sauvegarde des informations de la dette
                    $detteModel->save([
                        'date' => date('Y-m-d'), 
                        'montant_total' => $montant_total,
                        'montant_verse' => $montant_verse,
                        'montant_restant' => $montant_restant,
                        'utilisateursId' => $client->id 
                    ]);
    
                    // Récupération de l'ID de la dernière insertion
                    $detteId = $this->detteModel->lastInsertId();
    
                    // Sauvegarde des articles associés à la dette
                    foreach ($_SESSION['panier'] as $article) {
                        $this->articleModel->updateQteStock($article['id'], $article['quantite']); // Mise à jour du stock
    
                        // Sauvegarde des détails de l'article de la dette
                        $this->dettearticleModel->save([
                            'quantite' => $article['quantite'],
                            'dettesId' => $detteId, // Utilisation de l'ID récupéré
                            'articlesId' => $article['id']
                        ]);
                    }
    
                    return true; // Retourne true si tout se passe bien
                });
    
                // Vérification du résultat de la transaction
                if ($result) {
                    $_SESSION['panier'] = []; // Réinitialisation du panier
                    $successMessage = 'La dette a été enregistrée avec succès.'; // Message de succès
                    // Rendu de la vue avec le message de succès et le client
                    $this->renderView('enregistrerdette', [
                        'successMessage' => $successMessage,
                        'client' => $client
                    ]);
                } else {
                    // En cas d'erreur lors de l'enregistrement
                    $this->renderView('enregistrerdette', [
                        'client' => $client,
                        'panier' => $_SESSION['panier'],
                        'error' => 'Une erreur est survenue lors de l\'enregistrement de la dette.'
                    ]);
                }
            }
        }
    
        // Rendu de la vue si aucune action n'a été effectuée
        $this->renderView('enregistrerdette', [
            'client' => $client,
            'article' => $article,
            'error' => $error,
        ]);
    }
    
    
    
    
    
    
}

