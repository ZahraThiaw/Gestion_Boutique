<?php
namespace App\App\Model;

use App\App\Entity\DettearticleEntity;
use App\Core\Model\Model;
class DettearticleModel extends Model
{
    protected $table = 'dettearticles';
   
    public function getEntity() {
        return DettearticleEntity::class;
    }

}