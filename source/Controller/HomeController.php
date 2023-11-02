<?php

namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\ProduitProducteurModel;

use DateTime;

class HomeController extends MainController
{
    public function Index()
    {

        $ProduitModel = new ProduitModel();
        $CategorieModel = new CategorieModel;

        $allProducts = $ProduitModel->getProduits();
        $categories = $CategorieModel->Find();

        $sortedProducts = $this->sortBySaison($allProducts);

        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('products', $sortedProducts);
        ViewController::Set('categories', $categories);
        ViewController::Set('h1', 'Smarty : Hello World !');
        ViewController::Display('HomeView');
    }

    public function DescriptifProduit($params = [])
    {

        $ProduitModel = new ProduitModel();
        $Produit = $ProduitModel->DescriptifProduit($params['id']);
        $produitProducteurModel = new ProduitProducteurModel();
        $produitProducteurs = $produitProducteurModel->getProduitProducteur($params['id']);


        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('produit', $produitProducteurs);
        ViewController::Set('h1', 'Smarty : Hello World !');
        ViewController::Set('produitProducteur', $Produit);
        ViewController::Display('DescriptifProduitView');
        

        
    
    }
    
    
}