<?php
namespace App\App\Model;


use App\App\Entity\PaiementEntity;
use App\Core\Model\Model;
class PaiementModel extends Model
{
    protected $table = 'paiements';
   
    public function getEntity() {
        return PaiementEntity::class;
    }

}