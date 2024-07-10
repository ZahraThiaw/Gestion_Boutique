<?php
namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;

class DetteController extends Controller
{
    private $detteModel;

    public function __construct() {
        $this->detteModel = App::getInstance()->getModel("dette");
    }

    public function show() {
        $id = $_POST['id'];
        $Dettes = $this->detteModel->hasMany('utilisateursId', $id);
        var_dump($Dettes);
        $this->renderView('listerdettes', ['Dettes' => $Dettes]);
    }
}
