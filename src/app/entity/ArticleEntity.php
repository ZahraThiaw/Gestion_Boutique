<?php
namespace App\App\Entity;

use App\Core\Entity\Entity;

class ArticleEntity extends Entity
{
    private $id;
    private $reference;
    private $libelle;
    private $qteStock;
    private $prix;

    public function getId()
    {
        return $this->id;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function getQteStock()
    {
        return $this->qteStock;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    public function setQteStock($qteStock)
    {
        $this->qteStock = $qteStock;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    
}