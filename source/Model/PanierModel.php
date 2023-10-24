<?php

namespace Model;

use PDO;

class PanierModel extends DbModel
{
    private $db;

  
    public function getAllProduitsInfos($id)
    {
        
        $query = "SELECT * FROM produits WHERE id = :id";

    
        $stmt = $this->db->prepare($query);

        
        $stmt->bindParam(':id', $id);

       
        $stmt->execute();

        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

   
    public function getQuantiteProduit($id)
    {
       
        $query = "SELECT quantite FROM produits WHERE id = :id";

       
        $stmt = $this->db->prepare($query);

        
        $stmt->bindParam(':id', $id);

        // Exécutez la requête
        $stmt->execute();

        // Récupérez le résultat
        $result = $stmt->fetchColumn();

        return $result;
    }
}


