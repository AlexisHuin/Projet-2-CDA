<?php

namespace Model;

use Model\DbModel;

class ProduitProducteurModel extends DbModel
{
    protected $table = 'ProduitProducteur';
    protected string $id = 'IdProduitProducteur';
    

    public function getProduitProducteur($id): string|object|array
    {
        return DbModel::Select("SELECT * 
        FROM ProduitProducteur INNER JOIN Produit ON ProduitProducteur.IdProduitProduitProducteur=Produit.IdProduit
        WHERE IdProducteurProduitProducteur=:IdProducteurProduitProducteur",[':IdProducteurProduitProducteur'=>$id]);
    }
}