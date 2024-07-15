<?php
namespace App\Error;

enum HttpCode: int {
    case NotFound = 404;
    case Forbidden = 403;
}
