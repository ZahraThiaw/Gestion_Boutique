<?php
namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\DetteEntity;

class DetteModel extends Model
{
    protected $table = 'dettes';
   
    public function getEntity() {
        return DetteEntity::class;
    }


    public function findByTel($column, $value) {
        $sql = "SELECT d.utilisateursId,
                       SUM(d.montant_total) AS montant_total, 
                       SUM(d.montant_verse) AS montant_verse, 
                       SUM(d.montant_restant) AS montant_restant
                FROM dettes d 
                JOIN utilisateurs u ON d.utilisateursId = u.id
                GROUP BY d.utilisateursId
                HAVING d.utilisateursId = :$column AND montant_restant > 0";
        $data = [":$column" => $value];
        return $this->database->prepare($sql, $data, $this->getEntity(), true);
    }


    // public function hasMany($column, $value, $status = null) {
    //     $query = "SELECT * FROM dettes WHERE $column = :$column";
    //     $params = [':$column' => $value];
    
    //     if ($status !== null) {
    //         $query .= " AND montant_restant " . ($status == 1 ? "=" : ">") . " 0";
    //     } else {
    //         // Par défaut, afficher les dettes non soldées
    //         $query .= " AND montant_restant > 0";
    //     }
    
    //     return $this->prepare($query, $params, $this->getEntity(), false,);
    // }


    public function hasMany($column, $value, $status = null) {
        // Préparer la requête de base
        $query = "SELECT * FROM dettes WHERE $column = :value"; // Utilisez :value au lieu de :$column
        $params = [':value' => $value]; // Ajustez ici pour définir le paramètre correct
    
        // Vérifier le statut et modifier la requête si nécessaire
        if ($status !== null) {
            $query .= " AND montant_restant " . ($status == 1 ? "=" : ">") . " 0";
        } else {
            // Par défaut, afficher les dettes non soldées
            $query .= " AND montant_restant > 0";
        }
    
        // Appeler la méthode prepare avec la requête et les paramètres corrects
        return $this->prepare($query, $params, $this->getEntity(), false);
    }
    
    


    public function updateMontantRestant($id, $montant) {
        $sql = "UPDATE {$this->table} SET montant_restant = montant_restant - :montant WHERE id = :id";
        return $this->database->prepare($sql, ['id' => $id, 'montant' => $montant], $this->getEntity());
    }


    public function updateMontantVerse($id, $montant) {
        $sql = "UPDATE {$this->table} SET montant_verse = montant_verse + :montant WHERE id = :id";
        return $this->database->prepare($sql, ['id' => $id, 'montant' => $montant], $this->getEntity());
    }
    
    public function lastInsertId() {
        return $this->database->lastInsertId(); // Assurez-vous que $this->database est une instance de MysqlDatabase
    }
    
}
