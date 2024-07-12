<?php
namespace App\App\Entity;

use App\Core\Entity\Entity;

class DettearticleEntity extends Entity
{
    private $id;
    private $quantite;
    private $dettesId;
    private $articlesId;

    public function getId()
    {
        return $this->id;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function getDettesId()
    {
        return $this->dettesId;
    }

    public function getArticlesId()
    {
        return $this->articlesId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    public function setDettesId($dettesId)
    {
        $this->dettesId = $dettesId;
    }

    public function setArticlesId($articlesId)
    {
        $this->articlesId = $articlesId;
    }

}