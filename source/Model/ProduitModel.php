<?php
namespace Model;

use Model\DbModel;

class ProduitModel extends DbModel
{
    protected $table = 'Produit';

    public function getProduits()
    {
        return DbModel::Select('Select * from Produit inner join Categorie ON
        Produit.IdCategorieProduit=Categorie.IdCategorie
        inner join Saison ON
        
        Produit.IdSaisonProduit=Saison.IdSaison
        ');
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
        WHERE IdProduit = '$id'",[],  "Fetch");
    }

    public function getFilterByDesignation($DesignationProduit=null)
    {
        return DbModel::Select('Select * from Produit inner join Categorie ON
        Produit.IdCategorieProduit=Categorie.IdCategorie
        inner join Saison ON
        
        Produit.IdSaisonProduit=Saison.IdSaison
        WHERE 
        Produit.DesignationProduit LIKE "%'.$DesignationProduit.'%"');
    }

    public function getFilterByCategorie($IdCategorieProduit=null,$DesignationProduit=null)
    {
        return $this->Select('Select * from Produit inner join Categorie ON
        Produit.IdCategorieProduit=Categorie.IdCategorie
        inner join Saison ON
        Produit.IdSaisonProduit=Saison.IdSaison
        WHERE 
        Produit.IdCategorieProduit=:IdCategorieProduit AND
        Produit.DesignationProduit LIKE "%'.$DesignationProduit.'%"',
        [':IdCategorieProduit'=>$IdCategorieProduit]);
    }

    public function getFilterBySaison($IdSaisonProduit=null,$DesignationProduit=null)
    {
        return $this->Select('Select * from Produit inner join Categorie ON
        Produit.IdCategorieProduit=Categorie.IdCategorie
        inner join Saison ON
        Produit.IdSaisonProduit=Saison.IdSaison
        WHERE 
        Produit.IdSaisonProduit=:IdSaisonProduit AND
        Produit.DesignationProduit LIKE "%'.$DesignationProduit.'%"',
        [':IdSaisonProduit'=>$IdSaisonProduit]);
    }

    public function getFilterByCategorieSaison($IdCategorieProduit=null,$IdSaisonProduit=null,$DesignationProduit=null)
    {
        return $this->Select('Select * from Produit inner join Categorie ON
        Produit.IdCategorieProduit=Categorie.IdCategorie
        inner join Saison ON
        Produit.IdSaisonProduit=Saison.IdSaison
        WHERE 
        Produit.IdCategorieProduit=:IdCategorieProduit AND
        Produit.IdSaisonProduit=:IdSaisonProduit AND
        Produit.DesignationProduit LIKE "%'.$DesignationProduit.'%"
        ',[':IdCategorieProduit'=>$IdCategorieProduit,
        ':IdSaisonProduit'=>$IdSaisonProduit]);
    }

    public function DescriptifProduit($id)
    {
        $this->IdProduit = $id;
        return $this->FindOne();
    }

}

?>