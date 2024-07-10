<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;

class UtilisateurEntity extends Entity
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $motdepasse = 'passer123';
    private string $photo;
    private string $telephone;
    private string $rolesId;

    public function __construct()
    {
        // Constructeur vide ou ajouter une logique spécifique si nécessaire
    }

    // Pas besoin d'ajouter les getters, ils sont gérés par les méthodes magiques de la classe parente Entity


    // Ajoutez ici les getters et setters si nécessaire

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotdepasse() {
        return $this->motdepasse;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getRolesId() {
        return $this->rolesId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMotdepasse($motdepasse) {
        $this->motdepasse = $motdepasse;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function setRolesId($rolesId) {
        $this->rolesId = $rolesId;
    }
}
