<?php
namespace Model;


class PanierModel extends DbModel
{
    protected  $_table_name = "Panier";

    protected $id = "IdPanier";

    protected $Quantité = "QuantitéPanier";


    public function getPanier($IdProduit)
    {
        return DbModel::Select("INSERT INTO Panier (IdProduit, QuantitéProduitProducteur, PrixPanier, IdAdherentsPanier) VALUES (:IdProduit, :QuantitéPanier, :PrixPanier, :IdAdherentsPanier", 
        [':idProduit' =>$IdProduit],);

    }
    // public function updatePanier(){
    // // {
    // //     return DbModel::Update("INSERT INTO Panier (IdProduit, QuantitéProduitProducteur) VALUES (IdProduit QuantitéProduitProducteur);");
    // }

    public function DeleteProduitPanier()
    {
        return DbModel::Delete("DELETE FROM Panier WHERE IdProduit = IdPanier");

    }
    public function DeletePanier()
    {
        return DbModel::Delete("DELETE FROM Panier");

    }
}

