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

   
    // Mettre à jour la quantité de stock d'un article
    // public function updateQteStock($id, $qte) {
    //     $this->database->update('articles', [
    //         'qteStock' => $qte
    //     ], [
    //         'id' => $id
    //     ]);
    // }

    // Mettre à jour la quantité de stock d'un article
     public function updateQteStock($id, $qte) {
        $sql = "UPDATE {$this->table} SET qteStock = qteStock - :qte WHERE id = :id";
        return $this->database->prepare($sql, ['id' => $id, 'qte' => $qte], $this->getEntity());
    }
    

}
