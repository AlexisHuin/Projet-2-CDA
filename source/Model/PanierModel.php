<?php
namespace Model;

class PanierModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ajouterAuPanier($idProduit, $IdAdherents, $quantite)
    {
        $sql = "INSERT INTO Panier (IdProduit, IdUtilisateur, Quantite) 
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idProduit, $IdAdherents, $quantite]);
    }

    public function GetPanierAdherents($IdAdherents)
    {
        $sql = "SELECT * FROM Panier WHERE IdUtilisateur = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdAdherents]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function supprimerDuPanier($IdProduit, $IdAdherents)
    {
        $sql = "DELETE FROM Panier WHERE IdProduit = ? AND IdUtilisateur = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdProduit, $IdAdherents]);
    }
}
