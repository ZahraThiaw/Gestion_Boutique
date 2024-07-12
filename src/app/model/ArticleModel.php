<?php
namespace App\App\Model;

use App\App\Entity\ArticleEntity;
use App\Core\Model\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
   
    public function getEntity() {
        return ArticleEntity::class;
    }

}
