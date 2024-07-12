<?php
namespace App\App\Entity;

use App\Core\Entity\Entity;

class PaiementEntity extends Entity
{
    private $id;
    private $date;
    private $montant;
    private $dettesId;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function getDettesId()
    {
        return $this->dettesId;
    }

    public function setDettesId($dettesId)
    {
        $this->dettesId = $dettesId;
    }
}