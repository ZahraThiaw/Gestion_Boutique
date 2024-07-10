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

    // public function allDetteClient() {
    //     return $this->database->query("SELECT d.id, d.date, d.montant_total, d.montant_restant, d.utilisateursId, 
    //         u.prenom AS prenom, u.nom AS nom, u.telephone AS telephone
    //         FROM dettes d
    //         JOIN utilisateurs u ON d.utilisateursId = u.id
    //         WHERE d.utilisateursId = ? 
    //         AND d.montant_restant > 0;", [$utilisateursId], $this->getEntity(), false);
    // }
    

    // public function findByTel($column, $value) {
    //     $sql = "SELECT SUM(d.montant_total) AS montant_total, SUM(d.montant_verse) AS montant_verse, SUM(d.montant_restant) AS montant_restant
    //      FROM dettes d 
    //      JOIN utilisateurs u ON d.utilisateursId = u.id
    //      WHERE u.id = 4 && d.montant_restant > 0;
    //     ";
    //     $data = [":$column" => $value];
    //     return $this->database->prepare($sql, $data, $this->getEntity(), true);
    // }

    // public function findByTel($column, $value) {
    //     $sql = "SELECT d.utilisateursId, SUM(d.montant_total) AS montant_total, SUM(d.montant_verse) AS montant_verse, SUM(d.montant_restant) AS montant_restant
    //             FROM dettes d 
    //             GROUP BY d.utilisateursId
    //             HAVING d.utilisateursId = ? AND d.montant_restant > 0;
    //     ";

    //     $data = [":value" => $value];
    //     return $this->database->prepare($sql, $data, $this->getEntity(), true);
    // }


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
    
}
