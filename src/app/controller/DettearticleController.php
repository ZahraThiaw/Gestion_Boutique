<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class DettearticleController extends Controller {
    private $detteModel;
    private $utilisateurModel;
    private $dettearticleModel;
    private $articleModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->dettearticleModel = App::getInstance()->getModel("dettearticle");
        $this->articleModel = App::getInstance()->getModel("article");
    }


}