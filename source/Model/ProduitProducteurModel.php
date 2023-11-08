<?php

namespace Model;

use Model\DbModel;

class ProduitProducteurModel extends DbModel
{
    protected $table = 'ProduitProducteur';
    protected string $id = 'IdProduitProducteur';
    protected string $IdProducteur = 'IdProducteurProduitProducteur';

    // Méthode pour récupérer les produits du producteur en fonction de son ID
    public function getProduitProducteur(string|int $id, bool $validate = false): string|object|array
    {
        $this->IdProduitProduitProducteur = $id;
        if($validate){
            $this->IsValidateProduitProducteur = 1;
        }
        return $this->Find();
    }
    
    public function getProduitsProducteur($id): string|object|array
    {
        $this->IdProduitProduitProducteur = $id;
        $result = $this->Find('*', 'Fetch');
        return $result;
    }


    // Méthode pour mettre à jour les informations d'un produit du producteur
    public function producteurProduitUpdate($datas, $idProducteur, $IdProduitProducteur): string|object|array

    {
        return $this->Select("UPDATE ProduitProducteur 
        SET DesignationProduitProducteur=:DesignationProduitProducteur,
        PrixProduitProducteur=:PrixProduitProducteur, 
        QuantiteProduitProducteur=:QuantiteProduitProducteur,
        DetailsProduitProducteur=:DetailsProduitProducteur 
        WHERE IdProducteurProduitProducteur=:IdProducteurProduitProducteur AND IdProduitProducteur=:IdProduitProducteur
        ", [
            ':DesignationProduitProducteur' => $datas['DesignationProduitProducteur'],
            ':PrixProduitProducteur' => $datas['PrixProduitProducteur'],
            ':QuantiteProduitProducteur' => $datas['QuantiteProduitProducteur'],
            ':DetailsProduitProducteur' => $datas['DetailsProduitProducteur'],
            ':IdProducteurProduitProducteur' => $idProducteur,
            ':IdProduitProducteur' => $IdProduitProducteur,
        ]);
    }

    // Méthode pour supprimer un produit du producteur en fonction de son ID
    public function producteurProduitDelete($IdProduitProducteur): string|object|array
    {
        return $this->Select("DELETE FROM ProduitProducteur 
        WHERE IdProduitProducteur = $IdProduitProducteur
        ");
    }
    public function getOneProduitProducteur($id): string|object|array
    {
        return DbModel::Select("
        SELECT *
        FROM ProduitProducteur 
        WHERE IdProduitProducteur=:id", [':id' => $id], 'Fetch');
    }
}
