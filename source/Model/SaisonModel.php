<?php
namespace Model;

use Model\DbModel;

class SaisonModel extends DbModel
{
    protected $table = 'Saison';  
    
    public function getSaisons()
    {
        return DbModel::Select('SELECT * FROM Saison');
    }
    
    public function getProduits()
    {
        return DbModel::Select('SELECT DesignationProduit, IdProduit, DateDebutSaison, DateFinSaison 
        FROM Produit 
        INNER JOIN Categorie ON Produit.IdCategorieProduit = Categorie.IdCategorie
        INNER JOIN Saison ON Produit.IdSaisonProduit = Saison.IdSaison');
    }
}
?>
