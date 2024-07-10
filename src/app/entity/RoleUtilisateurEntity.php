<?php

namespace App\App\Entity;

use App\Core\Entity\Entity;


class RoleUtilisateurEntity extends Entity
{

    private $id;
    private $libelle;


    public function getId()
    {
        return $this->id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}