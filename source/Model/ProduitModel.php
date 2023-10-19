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
    public function DescriptifProduit($id)
    {
        $this->IdProduit = $id;
        return $this->FindOne();
    }

    // créé une fonction pour récupéré les produit proposé par le producteur
}

?>