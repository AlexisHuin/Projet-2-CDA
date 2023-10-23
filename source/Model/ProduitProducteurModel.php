<?php

namespace Model;

use Model\DbModel;

class ProduitProducteurModel extends DbModel
{
    protected $table = 'ProduitProducteur';
    protected string $id = 'IdProduitProducteur';
    

    public function getProduitProducteur($id): string|object|array
    {
        return DbModel::Find("SELECT * 
        FROM ProduitProducteur
        WHERE IdProduitProduitProducteur= '$id'");
    }
}