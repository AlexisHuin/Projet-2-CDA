<?php
namespace Model;

class PanierModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ajouterAuPanier($idProduit, $quantite)
    {
        $sql = "INSERT INTO Panier (IdProduit, Quantite) 
                VALUES ('', '', '')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idProduit,  $quantite]);
    }

    public function GetPanierAdherents($IdAdherents)
    {
        $sql = "SELECT * FROM Panier WHERE IdAdherents = ?";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function supprimerDuPanier($IdProduit, $IdAdherents)
    {
        $sql = "DELETE FROM Panier WHERE IdProduit = ? AND IdAdherents = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdProduit, $IdAdherents]);
    }
}
