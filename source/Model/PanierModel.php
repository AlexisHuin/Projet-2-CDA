<?php
namespace Model;
use Model\DbModel;

class PanierModel extends DbModel
{
    public string $table = "Panier";
    public string $id = "IdPanier";
    public string $Produits = "ProduitPanier";
    public string $Quantite = "QuantitePanier";
    public string $Prix = "PrixPanier";
    public string $IdAdherent = "IdAdherentsPanier";
}


