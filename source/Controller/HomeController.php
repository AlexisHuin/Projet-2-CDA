<?php
namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\SaisonModel;





class HomeController extends MainController
{
    public function Index()
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

    public function DescriptifProduit($params=[])
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Descriptif-Produit');
        $ProduitModel       = new ProduitModel();
        $Produit            = $ProduitModel->DescriptifProduit($params['id']);
        ViewController::Set('product',$Produit);
        ViewController::Display('DescriptifProduit');
        
        

        
    }
}