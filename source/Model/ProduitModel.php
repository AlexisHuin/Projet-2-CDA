<?php

namespace Model;

use Model\DbModel;
use DateTime;

class ProduitModel extends DbModel
{
    protected $table = 'Produit';
    protected $id = 'IdProduit';

    public function getProduits()
    {
        $this->Join(["IdCategorieProduit", "IdSaisonProduit"], ["Categorie" => "IdCategorie","Saison" => "IdSaison"]);

        return $this->Find();
    }

    public function getAllProduitsInfos(): string|object|array
    {
        return DbModel::Select('
        SELECT NomSaison, DesignationProduit, IdProduit, DesignationCategorie 
        FROM Produit 
        INNER JOIN Categorie ON Produit.IdCategorieProduit=Categorie.IdCategorie
        INNER JOIN Saison ON Produit.IdSaisonProduit=Saison.IdSaison
        ');
    }

    public function getOneProduitInfos($id): string|object|array
    {
        return DbModel::Select("
        SELECT NomSaison, IdSaisonProduit, IdCategorieProduit, DesignationProduit, IdProduit, DesignationCategorie 
        FROM Produit 
        INNER JOIN Categorie ON Produit.IdCategorieProduit=Categorie.IdCategorie
        INNER JOIN Saison ON Produit.IdSaisonProduit=Saison.IdSaison
        WHERE IdProduit = '$id'", [],  "Fetch");
    }

    public function DescriptifProduit($id)
    {
        $this->IdProduit = $id;
        return $this->Find('*', 'Fetch');
    }
}
