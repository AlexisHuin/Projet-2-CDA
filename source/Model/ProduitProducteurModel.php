<?php

namespace Model;

use Model\DbModel;

class ProduitProducteurModel extends DbModel
{
    protected $table = 'ProduitProducteur';
    protected string $id = 'IdProduitProducteur';
    protected string $IdProducteur = 'IdProducteurProduitProducteur';

    public function getProduitProducteur($id): string|object|array
    {
        return DbModel::Select("SELECT * 
        FROM ProduitProducteur INNER JOIN Produit ON ProduitProducteur.IdProduitProduitProducteur=Produit.IdProduit
        WHERE IdProducteurProduitProducteur=:IdProducteurProduitProducteur",[':IdProducteurProduitProducteur'=>$id]);
    }

    public function producteurProduitUpdate($datas,$idProducteur,$IdProduit): string|object|array
    {
       return $this->Select("UPDATE ProduitProducteur 
        SET DesignationProduitProducteur=:DesignationProduitProducteur,
        PrixProduitProducteur=:PrixProduitProducteur, 
        QuantiteProduitProducteur=:QuantiteProduitProducteur,
         DetailsProduitProducteur=:DetailsProduitProducteur 
        WHERE IdProducteurProduitProducteur=:IdProducteurProduitProducteur AND IdProduitProduitProducteur=:IdProduitProduitProducteur
        ",[
          ':DesignationProduitProducteur'=>$datas['DesignationProduitProducteur'],
          ':PrixProduitProducteur'=>$datas['PrixProduitProducteur'],
          ':QuantiteProduitProducteur'=>$datas['QuantiteProduitProducteur'],
          ':DetailsProduitProducteur'=>$datas['DetailsProduitProducteur'],
          ':IdProducteurProduitProducteur'=>$idProducteur,
          ':IdProduitProduitProducteur'=>$IdProduit,
        ]);
    }
}