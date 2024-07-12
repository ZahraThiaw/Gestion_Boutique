<?php
namespace App\Core;

class Validator {
    private $errors = [];
    
    // Ajout d'une méthode générique pour valider l'unicité d'un champ
    public function validateUnique($field, $value, $model, $column) {
        if ($model->findBy($column, $value)) {
            $this->errors[$field] = "Ce $field est déjà utilisé.";
        }
    }

    public function validateRequired($field, $value) {
        if (empty($value)) {
            $this->errors[$field] = 'Ce champ est requis.';
        }
    }

    public function validateEmail($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = 'Email invalide.';
        }
    }

    public function validateMinLength($field, $value, $minLength) {
        if (strlen($value) < $minLength) {
            $this->errors[$field] = "Ce champ doit contenir au moins $minLength caractères.";
        }
    }

    public function validateMaxLength($field, $value, $maxLength) {
        if (strlen($value) > $maxLength) {
            $this->errors[$field] = "Ce champ ne doit pas dépasser $maxLength caractères.";
        }
    }

    public function validateNumeric($field, $value) {
        if (!is_numeric($value)) {
            $this->errors[$field] = 'Ce champ doit être un nombre.';
        }
    }

    public function validatemax($field, $value, $max) {
        if ($value > $max) {
            $this->errors[$field] = 'Ce champ doit être inferieur à '.$max;
        }
    }

    public function validatemin($field, $value, $min) {
        if ($value < $min) {
            $this->errors[$field] = 'Ce champ doit être superieur à '.$min;
        }
    }

    public function validateMatch($field, $value, $fieldToMatch, $valueToMatch) {
        if ($value !== $valueToMatch) {
            $this->errors[$field] = 'Les champs ne correspondent pas.';
        }
    }

    public function validatePhone($field, $value) {
        if (!preg_match('/^(76|77|78|70|75)\d{7}$/', $value)) {
            $this->errors[$field] = 'Numéro de téléphone invalide.';
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return !empty($this->errors);
    }

    public function validate($data, $rules, $model = null) {
        foreach ($rules as $field => $ruleset) {
            $value = isset($data[$field]) ? $data[$field] : null;
            foreach ($ruleset as $rule => $ruleValue) {
                if ($rule === 'unique') {
                    $this->validateUnique($field, $value, $model, $ruleValue);
                } else {
                    $methodName = 'validate' . ucfirst($rule);
                    if (method_exists($this, $methodName)) {
                        $this->{$methodName}($field, $value, $ruleValue);
                    }
                }
            }
        }
    }
}
