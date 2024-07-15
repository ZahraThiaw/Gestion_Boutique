<?php

namespace App\Core\Validator;

class Validator implements ValidatorInterface {
    private $rules = [];
    private $errors = [];

    public function validate(array $data, array $rules, $model = null): array {
        $this->rules = $rules;
        foreach ($rules as $field => $ruleset) {
            $value = $data[$field] ?? null;
            foreach ($ruleset as $rule => $ruleValue) {
                $methodName = 'validate' . ucfirst($rule);
                if (method_exists($this, $methodName)) {
                    $this->{$methodName}($field, $value, $ruleValue, $model);
                }
            }
        }
        return $this->errors;
    }

    private function validateRequired($field, $value) {
        if (empty($value)) {
            $this->errors[$field] = 'Ce champ est requis.';
        }
    }

    private function validateEmail($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = 'Email invalide.';
        }
    }

    private function validateMinLength($field, $value, $minLength) {
        if (strlen($value) < $minLength) {
            $this->errors[$field] = "Ce champ doit contenir au moins $minLength caractères.";
        }
    }

    private function validateMaxLength($field, $value, $maxLength) {
        if (strlen($value) > $maxLength) {
            $this->errors[$field] = "Ce champ ne doit pas dépasser $maxLength caractères.";
        }
    }

    private function validateNumeric($field, $value) {
        if (!is_numeric($value)) {
            $this->errors[$field] = 'Ce champ doit être un nombre.';
        }
    }

    private function validateMax($field, $value, $max) {
        if ($value > $max) {
            $this->errors[$field] = 'Ce champ doit être inférieur à ' . $max;
        }
    }

    private function validateMin($field, $value, $min) {
        if ($value < $min) {
            $this->errors[$field] = 'Ce champ doit être supérieur à ' . $min;
        }
    }

    private function validateMatch($field, $value, $fieldToMatch, $valueToMatch) {
        if ($value !== $valueToMatch) {
            $this->errors[$field] = 'Les champs ne correspondent pas.';
        }
    }

    private function validatePhone($field, $value) {
        if (!preg_match('/^(76|77|78|70|75)\d{7}$/', $value)) {
            $this->errors[$field] = 'Numéro de téléphone invalide.';
        }
    }

    private function validateUnique($field, $value, $model, $column) {
        if ($model->findBy($column, $value)) {
            $this->errors[$field] = "Ce $field est déjà utilisé.";
        }
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function hasErrors(): bool {
        return !empty($this->errors);
    }
}
