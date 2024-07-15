<?php

namespace App\Core\Validator;

interface ValidatorInterface {
    public function validate(array $data, array $rules, $model = null): array;
    public function getErrors(): array;
    public function hasErrors(): bool;
}
