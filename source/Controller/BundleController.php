<?php

namespace Controller;

use Model\ProduitProducteurModel;

class BundleController extends MainController
{

    // fonction pour afficher la page Contact

    public function Bundle(): void
    {
        $Produits = new ProduitProducteurModel();
        $AllProduits = $Produits->getProduitProducteur($_SESSION['user']['IdRole'], true);

        ViewController::Set('title', 'Gérer mes bundles');
        ViewController::Set('AllProduits', $AllProduits);
        ViewController::Display('BundleView');
    }
}
