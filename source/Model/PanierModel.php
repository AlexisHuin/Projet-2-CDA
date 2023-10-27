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
        $query = "SELECT quantite FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $IdProduit);
        $stmt->execute();
        $result = $stmt->fetch;

        if ($result) {
            return $result['quantite'];
        } else {
            throw new \Exception('Product not found');
        }
    }

    public function addToCart($IdProduit, $quantite, $prix, $IdAdherentPanier)
    {
        // Implement logic to add a product to the user's cart
        // Example:
        $query = "INSERT INTO cart (IdProduit, quantite, prix, IdAdherentsPanier) VALUES (:IdProduit, :quantite, :prix, :IdAdherentsPanier)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':productId', $IdProduit);
        $stmt->bindParam(':quantity', $quantite);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':IdAdherentsPanier', $IdAdherentPanier);
        $stmt->execute();
    }

    public function removeFromCart($IdProduit, $IdadherentPanier)
    {
        // Implement logic to remove a product from the user's cart
        // Example:
        $query = "DELETE FROM cart WHERE product_id = :productId AND user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':productId', $IdProduit);
        $stmt->bindParam(':IdAdherentsPanier', $IdadherentPanier);
        $stmt->execute();
    }

   
}


