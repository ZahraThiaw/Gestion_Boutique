<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class ArticleController extends Controller {
    private $detteModel;
    private $utilisateurModel;
    private $articleModel;
    private $dettearticleModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->articleModel = App::getInstance()->getModel("article");
        $this->dettearticleModel = App::getInstance()->getModel("dettearticle");
    }

    public function showarticle() {
        // Recuperer l'ID de la dette depuis le formulaire POST
        $id = $_POST['id'];

        // Recuperer les informations de la dette
        $dette = $this->detteModel->findBy('id', $id);
        //var_dump($dette);

        //Recuperer les informations du client
        $client = $this->utilisateurModel->findBy('id', $dette->utilisateursId);
        //var_dump($client);
        
        // Recuperer les articles de la dette
        $articles = $this->articleModel->belongsToMany('dettearticles','articlesId', $id, 'articles', 'dettesId');
        //var_dump($articles);
        
        // Recupérer les quantités des articles de la dette
        $dettearticles = $this->dettearticleModel->findBy('dettesId', $id);

        // Passer les données à la vue 'listerarticles.html.php'
        $this->renderView('listerarticles', [
            'dette' => $dette,
            'client' => $client,
            'articles' => $articles,
            'dettearticles' => $dettearticles
        ]);
        
    }

}