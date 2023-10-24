<?php
namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\SaisonModel;
use Model\ProduitProducteurModel;





class HomeController extends MainController
{
    public function Index()
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('h1', 'Smarty : Hello World !');
        
        $ProduitModel = new ProduitModel();

        $DesignationProduit = null;

        if(isset($_POST['DesignationProduit']) && 
        !empty($_POST['DesignationProduit']) && 
        strlen($_POST['DesignationProduit']) >=3)
        $DesignationProduit = $_POST['DesignationProduit'];

        if(isset($_POST['IdCategorieProduit']) && 
        !empty($_POST['IdCategorieProduit']) && 
        isset($_POST['IdSaisonProduit']) && 
        !empty($_POST['IdSaisonProduit'])
        )
        {
            $ProduitsList = $ProduitModel->getFilterByCategorieSaison($_POST['IdCategorieProduit'],$_POST['IdSaisonProduit'],$DesignationProduit);
        }
        elseif(isset($_POST['IdCategorieProduit']) && 
        !empty($_POST['IdCategorieProduit']) 
        )
        {
            $ProduitsList = $ProduitModel->getFilterByCategorie($_POST['IdCategorieProduit'],$DesignationProduit);
            
        }
        elseif(isset($_POST['IdSaisonProduit']) && 
        !empty($_POST['IdSaisonProduit']) 
        )
        {
            $ProduitsList = $ProduitModel->getFilterBySaison($_POST['IdSaisonProduit'],$DesignationProduit);
            
        }
        else{
            $ProduitsList = $ProduitModel->getFilterByDesignation($DesignationProduit);
        }
        
        ViewController::Set('products',$ProduitsList);


        $CategorieModel = new CategorieModel();
        ViewController::Set('categories',$CategorieModel->getCategories());
        
        $SaisonModel = new SaisonModel();
        ViewController::Set('saisons',$SaisonModel->getSaisons());


        ViewController::Display('HomeView');
    }

    public function DescriptifProduit($params=[])
    {
        if (isset($_SESSION['panier'])) {
            $ProduitModel = new ProduitModel();
            $Produit = $ProduitModel->DescriptifProduit($params['id']);
    
            $ProduitProducteurModel = new ProduitProducteurModel();}
        
        // var_dump($Produit);
        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('product',$Produit);
        ViewController::Set('h1', 'Smarty : Hello World !');
        ViewController::Display('DescriptifProduit');
    }
}