<?php

namespace App\Core\Securite;

use App\Core\Database\MysqlDatabase;
use App\App\Entity\UtilisateurEntity;
use App\App\Entity\RoleUtilisateurEntity;

class SecurityDatabase {
    private $database;

    public function __construct(MysqlDatabase $database) {
        $this->database = $database;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email AND motdepasse = :motdepasse";
        $user = $this->database->prepare($sql, ['email' => $email, 'motdepasse' => $password], UtilisateurEntity::class, true);

        if ($user && password_verify($password, $user->getMotdepasse())) {
            $_SESSION['user_id'] = $user->getId();
            return true;
        }
        return false;
    }

    public function isLogged(): bool {
        return isset($_SESSION['user_id']);
    }

    public function getRoles() {
        if (!$this->isLogged()) {
            return null;
        }

        $sql = "SELECT r.libelle FROM roles r 
                INNER JOIN utilisateurs_roles ur ON ur.role_id = r.id 
                WHERE ur.utilisateur_id = :user_id";
        return $this->database->prepare($sql, ['user_id' => $_SESSION['user_id']], RoleUtilisateurEntity::class);
    }

    public function getUserLogged() {
        if (!$this->isLogged()) {
            return null;
        }

        $sql = "SELECT * FROM utilisateurs WHERE id = :user_id";
        return $this->database->prepare($sql, ['user_id' => $_SESSION['user_id']], UtilisateurEntity::class, true);
    }
}

