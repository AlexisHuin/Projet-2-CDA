<?php

namespace Controller;

use Model\ProduitModel;
use Model\ProduitProducteurModel;
use Controller\ViewController;

use Controller\ExceptionHandler;


class ProducteurController extends UserController
{
    public function AddProduct(): void
    {


        if (isset($_POST['Ajouter'])) {
            $datas = $this->validate($_POST, [
                'DesignationProduitProducteur', 'PrixProduitProducteur',
                'DetailsProduitProducteur', 'QuantiteProduitProducteur', 'IdProduitProduitProducteur'
            ]);
            $idProducteur = $_SESSION['user']['IdRole'];


            if ($datas !== false) {
                $ProduitProducteur = new ProduitProducteurModel();
                $ProduitProducteur->IdProducteurProduitProducteur = $idProducteur;
                $ProduitProducteur->IdProduitProduitProducteur  = $datas['IdProduitProduitProducteur'];
                $ProduitProducteur->DesignationProduitProducteur = htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES);
                $ProduitProducteur->PrixProduitProducteur = $datas['PrixProduitProducteur'];
                $ProduitProducteur->DetailsProduitProducteur = $datas['DetailsProduitProducteur'];
                $ProduitProducteur->PrixProduitProducteur = $datas['PrixProduitProducteur'];
                // $ProduitProducteur->ImageProduitProducteur = $datas['ImageProduitProducteur'];
                $ProduitProducteur->QuantiteProduitProducteur = $datas['QuantiteProduitProducteur'];

                $ProduitProducteur->Save();
                header('location: /User/AddProduct?info=Produit ajouté avec succés');
                exit();
            } else {
                ExceptionHandler::SetUserError("Erreur");
                $errors = ExceptionHandler::GetUserError();
            }
            var_dump($errors);
        }

        
        $Produits = new ProduitModel;
        // Récupérer la liste de tous les produits (c'est un exemple, adaptez-le à vos besoins)
        $allProducts = $Produits->getAllProduitsInfos();
        usort($allProducts, function ($a, $b) {
            return strcmp($a['DesignationProduit'], $b['DesignationProduit']);
        });

        // Récupérer les produits associés à l'utilisateur
        // $userProducts = $ListProduitProducteur->getProduitProducteur();



        ViewController::Init('smarty');

        if (isset($_GET['info']) && !empty($_GET['info'])) 
            ViewController::Set('info', $_GET['info']); 
        
        ViewController::Set('title', 'Gestion de produit');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('AllProducts', $allProducts);
        // ViewController::Set('UserProducts', $userProducts);
        ViewController::Display('AddProductProducteurView');
    }
    public function ProductList(): void {
          // Créez une instance de DbModel pour la table ProduitProducteur
          $Produits = new ProduitProducteurModel();
          $AllProduits = $Produits->getProduitProducteur($_SESSION['user']['IdRole']);
   
         ViewController::Init('smarty');
         ViewController::Set('title', 'Mes produits');
         ViewController::Set('SessionInfo', $_SESSION['user']);
         ViewController::Set('AllProduits', $AllProduits);
         ViewCOntroller::Display('ProduitProducteurListView');

        //  var_dump($_SESSION['user']['IdRole']);
          // var_dump($Produits);
    var_dump($AllProduits);
         
    }
}
