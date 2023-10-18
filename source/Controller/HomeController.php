<?php
namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\SaisonModel;





class HomeController extends MainController
{
    public function Index() : void
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('h1', 'Smarty : Hello World !');
        
        $ProduitModel = new ProduitModel();
        ViewController::Set('products',$ProduitModel->getProduits());

        $CategorieModel = new CategorieModel();
        ViewController::Set('categories',$CategorieModel->getCategories());
        
        $SaisonModel = new SaisonModel();
        ViewController::Set('saisons',$SaisonModel->getSaisons());

        ViewController::Display('HomeView');
    }

    public function DescriptifProduit($params=[]) : void
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        $ProduitModel       = new ProduitModel();
        $Produit            = $ProduitModel->DescriptifProduit($params['id']);
        ViewController::Set('product',$Produit);
        ViewController::Set('h1', 'Smarty : Hello World !');
        ViewController::Display('DescriptifProduit');
        
        

        
    }
}