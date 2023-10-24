<?php

namespace Model;

use Model\DbModel;

class ProduitProducteurModel extends DbModel
{
    protected $table = 'ProduitProducteur';
    protected string $id = 'IdProduitProducteur';
    protected string $IdProducteur = 'IdProducteurProduitProducteur';

    // Méthode pour récupérer les produits du producteur en fonction de son ID
    public function getProduitProducteur($id): string|object|array
    {
        return DbModel::Select("SELECT * 
        FROM ProduitProducteur INNER JOIN Produit ON ProduitProducteur.IdProduitProduitProducteur=Produit.IdProduit
        WHERE IdProducteurProduitProducteur=:IdProducteurProduitProducteur", [':IdProducteurProduitProducteur' => $id]);
    }


    // Méthode pour mettre à jour les informations d'un produit du producteur
    public function producteurProduitUpdate($datas, $idProducteur, $IdProduit): string|object|array

    {
        return $this->Select("UPDATE ProduitProducteur 
        SET DesignationProduitProducteur=:DesignationProduitProducteur,
        PrixProduitProducteur=:PrixProduitProducteur, 
        QuantiteProduitProducteur=:QuantiteProduitProducteur,
        DetailsProduitProducteur=:DetailsProduitProducteur 
        WHERE IdProducteurProduitProducteur=:IdProducteurProduitProducteur AND IdProduitProduitProducteur=:IdProduitProduitProducteur
        ", [
            ':DesignationProduitProducteur' => $datas['DesignationProduitProducteur'],
            ':PrixProduitProducteur' => $datas['PrixProduitProducteur'],
            ':QuantiteProduitProducteur' => $datas['QuantiteProduitProducteur'],
            ':DetailsProduitProducteur' => $datas['DetailsProduitProducteur'],
            ':IdProducteurProduitProducteur' => $idProducteur,
            ':IdProduitProduitProducteur' => $IdProduit,
        ]);
    }

    // Méthode pour supprimer un produit du producteur en fonction de son ID
    public function producteurProduitDelete($IdProduit): string|object|array
    {
        return $this->Select("DELETE FROM ProduitProducteur 
        WHERE IdProduitProduitProducteur = $IdProduit
        ");
    }
    
}


// voir pour supprimé l'image de VS CODE quand je supprime un produit  Unlink