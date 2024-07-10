<?php
namespace App\App\Entity;

use App\Core\Entity\Entity;

class DetteEntity extends Entity
{
    private $id;
    private $date;
    private $montant_total; 
    private $montant_verse; 
    private $montant_restant; 
    private $utilisateursId;

    // Les autres getters et setters...
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getMontantTotal() {
        return $this->montant_total;
    }

    public function setMontantTotal($montant_total) {
        $this->montant_total = $montant_total;
    }

    public function getMontantVerse() {
        return $this->montant_verse;
    }

    public function setMontantVerse($montant_verse) {
        $this->montant_verse = $montant_verse;
    }

    public function getMontantRestant() {
        return $this->montant_restant;
    }

    public function setMontantRestant($montant_restant) {
        $this->montant_restant = $montant_restant;
    }

    public function getUtilisateursId() {
        return $this->utilisateursId;
    }

    public function setUtilisateursId($utilisateursId) {
        $this->utilisateursId = $utilisateursId;
    }
}
