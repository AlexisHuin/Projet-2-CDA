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
        // Vérifie si le formulaire d'ajout a été soumis
        if (isset($_POST['Ajouter'])) {
            // Valide les données du formulaire
            $datas = $this->validate($_POST, [
                'DesignationProduitProducteur', 'PrixProduitProducteur',
                'DetailsProduitProducteur', 'QuantiteProduitProducteur', 'IdProduitProduitProducteur'
            ]);
            $idProducteur = $_SESSION['user']['IdRole'];

            if ($datas !== false) {
                // Crée un modèle ProduitProducteur
                $ProduitProducteur = new ProduitProducteurModel();
                // Remplit les propriétés du modèle avec les données du formulaire
                $ProduitProducteur->IdProducteurProduitProducteur = $idProducteur;
                $ProduitProducteur->IdProduitProduitProducteur  = $datas['IdProduitProduitProducteur'];
                $ProduitProducteur->DesignationProduitProducteur = htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES);
                $ProduitProducteur->PrixProduitProducteur = $datas['PrixProduitProducteur'];
                $ProduitProducteur->DetailsProduitProducteur = $datas['DetailsProduitProducteur'];
                $ProduitProducteur->QuantiteProduitProducteur = $datas['QuantiteProduitProducteur'];

                // Enregistre les données dans la base de données
                $ProduitProducteur->Save();
                // Redirige l'utilisateur avec un message de succès
                header('location: /User/AddProduct?info=Produit ajouté avec succès');
                exit();
            } else {
                // Gère les erreurs de validation
                ExceptionHandler::SetUserError("Erreur");
                $errors = ExceptionHandler::GetUserError();
            }
            var_dump($errors);
        }

        // Récupère la liste de tous les produits depuis la base de données
        $Produits = new ProduitModel;
        $allProducts = $Produits->getAllProduitsInfos();
        usort($allProducts, function ($a, $b) {
            return strcmp($a['DesignationProduit'], $b['DesignationProduit']);
        });

        // Initialise la vue avec des données
        ViewController::Init('smarty');
        ViewController::Set('info', $_GET['info']);
        ViewController::Set('title', 'Gestion de produit');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('AllProducts', $allProducts);
        ViewController::Display('AddProductProducteurView');
    }

    public function ProductList(): void
    {
        // Vérifie si l'utilisateur a soumis un formulaire de suppression
        if (isset($_POST['delete'])) {
            $this->DeleteProductProducteur();
        }

        // Vérifie si l'utilisateur a soumis un formulaire de mise à jour
        if (isset($_POST['update'])) {
            $this->UpdateProductProducteur();
        }

        // Crée une instance de ProduitProducteurModel pour gérer les produits du producteur
        $Produits = new ProduitProducteurModel();
        $AllProduits = $Produits->getProduitProducteur($_SESSION['user']['IdRole']);

        // Initialise la vue et fournit les données à afficher
        ViewController::Init('smarty');
        ViewController::Set('title', 'Mes produits');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('AllProduits', $AllProduits);
        ViewCOntroller::Display('ProduitProducteurListView');
    }

    private function UpdateProductProducteur(): void
    {
        // Récupère l'ID du producteur à partir de la session
        $idProducteur = $_SESSION['user']['IdRole'];

        // Vérifie si un tableau de produits à mettre à jour a été soumis
        if (is_array($_POST['produit'])) {
            foreach ($_POST['produit'] as $IdProduit => $datas) {
                // Valide les données du formulaire
                $datas = $this->validate($datas, ['DesignationProduitProducteur', 'PrixProduitProducteur', 'QuantiteProduitProducteur', 'DetailsProduitProducteur']);
                if ($datas !== false) {
                    // Crée un modèle ProduitProducteur et effectue la mise à jour
                    $ProduitProducteurModel = new ProduitProducteurModel();
                    $ProduitProducteurModel->producteurProduitUpdate($datas, $idProducteur, $IdProduit);
                }
            }
        }
    }

    private function DeleteProductProducteur(): void
    {
        // Vérifie si un formulaire de suppression a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['deleteProduit']) && is_array($_POST['deleteProduit'])) {
                $Produit = new ProduitProducteurModel();

                // Parcourt les produits à supprimer et les supprime un par un
                foreach ($_POST['deleteProduit'] as $productId => $value) {
                    // Supprime le produit correspondant
                    $Produit->producteurProduitDelete($productId);
                }
            }
        }
    }
}
