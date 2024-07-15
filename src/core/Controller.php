<?php
namespace App\Core;

abstract class Controller {

    protected $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    protected function renderView($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../../views/{$view}.html.php";
    }

    protected function renderJson($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}






// namespace App\Core;

// use App\Core\Validator\ValidatorInterface;

// abstract class Controller {
//     protected $session;
//     protected ValidatorInterface $validator;

//     public function __construct(ValidatorInterface $validator) {
//         $this->session = new Session();
//         $this->validator = $validator;
//     }

//     protected function redirect($url) {
//         header("Location: {$url}");
//         exit;
//     }
    
//     protected function renderView($view, $data = []) {
//         extract($data);
//         require_once __DIR__ . "/../../views/{$view}.html.php";
//     }

//     protected function renderJson($data) {
//         header('Content-Type: application/json');
//         echo json_encode($data);
//     }
// }

