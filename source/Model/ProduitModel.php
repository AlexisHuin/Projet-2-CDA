<?php
namespace Model;

use Model\DbModel;
use DateTime;

class ProduitModel extends DbModel
{
    protected $table = 'Produit';

    public function getProduits() : string|object|array
    {
        $produitsPasSaison = DbModel::Select('Select * from Produit inner join Categorie ON
        Produit.IdCategorieProduit=Categorie.IdCategorie
        inner join Saison ON
        
        Produit.IdSaisonProduit=Saison.IdSaison
        ');

        $nowNoFormat = new DateTime();
        $now = $nowNoFormat->format('m-d');

        $produits = array();
        for($i = 0; $i < count($produitsPasSaison); $i++){
            $debutNoFormat = new DateTime($produitsPasSaison[$i]['DateDebutSaison']);
            $finNoFormat = new DateTime($produitsPasSaison[$i]['DateFinSaison']);

            $debut = $debutNoFormat->format('m-d');
            $fin = $finNoFormat->format('m-d');

            if($now >= $debut && $now <= $fin){
                $produits[] = [
                    "DesignationProduit" => $produitsPasSaison[$i]['DesignationProduit'],
                    "DesignationCategorie" => $produitsPasSaison[$i]['DesignationCategorie'],
                    "IdProduit" => $produitsPasSaison[$i]['IdProduit'],
                    "DesignationProduit" => $produitsPasSaison[$i]['DesignationProduit']
                ];
            }
        }
        // var_dump($produits);
        return $produits;
    }
    public function DescriptifProduit($id)  : string|object|array
    {
        $this->IdProduit = $id;
        return $this->FindOne();
    }
}

?>