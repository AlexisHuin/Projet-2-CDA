<?php

namespace Model;

use Model\DbModel;

class ProduitModel extends DbModel
{
    protected $table = 'Produit';

    public function getProduits(): string|object|array
    {
        $produitsPasSaison = DbModel::Select('Select * from Produit inner join Categorie ON
        Produit.IdCategorieProduit=Categorie.IdCategorie
        inner join Saison ON
        
        Produit.IdSaisonProduit=Saison.IdSaison
        ');

        return $produitsPasSaison;
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
        SELECT NomSaison, DesignationProduit, IdProduit, DesignationCategorie 
        FROM Produit 
        INNER JOIN Categorie ON Produit.IdCategorieProduit=Categorie.IdCategorie
        INNER JOIN Saison ON Produit.IdSaisonProduit=Saison.IdSaison
        WHERE IdProduit = '$id'", "Fetch");
    }

    public function DescriptifProduit($id): string|object|array
    {
        $this->IdProduit = $id;
        return $this->FindOne();
    }

    // créé une fonction pour récupéré les produit proposé par le producteur
}
