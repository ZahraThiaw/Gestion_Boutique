<?php
namespace App\Error;

use App\Core\Controller;

class ErrorController extends Controller {

    public function loadView(HttpCode $code) {
        $view = '';
        switch ($code) {
            case HttpCode::NotFound:
                $view = 'errors/404';
                break;
            case HttpCode::Forbidden:
                $view = 'errors/403';
                break;
        }
        $this->renderView($view);
    }
}
