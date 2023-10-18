<?php
namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;


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


        ViewController::Display('HomeView');
    }

    public function DescriptifProduit()
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('h1', 'Smarty : Hello World !');
        ViewController::Display('HomeView');
    }
}