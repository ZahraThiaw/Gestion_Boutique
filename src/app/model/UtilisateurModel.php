<?php

namespace App\App\Model;

use App\Core\Model\Model;
use App\App\Entity\UtilisateurEntity;

class UtilisateurModel extends Model
{
    protected $table = 'utilisateurs';
   
    public function getEntity() {
        return UtilisateurEntity::class;
    }

    public function all() {
        return $this->database->query("SELECT * FROM " . $this->table, false);
    }

    public function findByTelephone($telephone) {
        $sql = "
            SELECT u.id, u.nom, u.prenom, u.email, u.telephone, SUM(d.montant_total) AS montant_total, SUM(d.montant_verse) AS montant_verse, SUM(d.montant_restant) AS montant_restant
            FROM utilisateurs u
            LEFT JOIN dettes d ON u.id = d.utilisateursId AND d.montant_restant > 0
            GROUP BY u.id
            HAVING u.telephone = ?;
        ";
        $data = [":telephone" => $telephone];
        $resultat = $this->database->prepare($sql, $data, $this->getEntity(), true);
        return $resultat;
    }

    


    

    

    
}


