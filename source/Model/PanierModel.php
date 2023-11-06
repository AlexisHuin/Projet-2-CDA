<?php
namespace Model;
use Model\DbModel;

class PanierModel extends DbModel
{
    public static $db;

    public function getQuantiteProduit($IdProduit)
    {
        // Implement logic to fetch the quantity of the product with the given ID from the database
        // Example:
        $query = "SELECT Quantite FROM Produit WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $IdProduit);
        $stmt->execute();
        $result = $stmt->fetch;

        if ($result) {
            return $result['Quantite'];
        } else {
            throw new \Exception('Product not found');
        }
    }

    public function addToCart($IdProduit, $Quantite, $PrixPanier, $IdAdherentPanier)
    {
        $query = "INSERT INTO Panier (IdProduit, Quantite, PrixPanier, IdAdherentPanier) VALUES (:IdProduit, :Quantite, :PrixPanier, :IdAdherentPanier)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':IdProduit', $IdProduit);
        $stmt->bindParam(':Quantite', $Quantite);
        $stmt->bindParam(':Prix', $PrixPanier);
        $stmt->bindParam(':IdAdherentPanier', $IdAdherentPanier);
        $stmt->execute();
    }

    public function removeFromCart($IdProduit, $IdAdherentPanier)
    {
        // Implement logic to remove a product from the user's cart
        // Example:
        $query = "DELETE FROM Panier WHERE IdProduit = :IdPRoduit AND user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':IdProduit', $IdProduit);
        $stmt->bindParam(':IdAdherentPanier', $IdAdherentPanier);
        $stmt->execute();
    }

   
}


