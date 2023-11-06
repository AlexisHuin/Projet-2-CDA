<?php

namespace Controller;

use Model\ProduitModel;
use Model\ProduitProducteurModel;
use Model\DemandesModel;
use Controller\ViewController;
use Controller\ExceptionHandler;


class ProducteurController extends UserController
{
    public function AddProduct(): void
    {
        $this->connectCheck('user', 'Producteur');
        // Vérifie si le formulaire d'ajout a été soumis
        if (isset($_POST['Ajouter'])) {
            // Valide les données du formulaire
            $datas = $this->validate($_POST, [
                'DesignationProduitProducteur', 'PrixProduitProducteur',
                'DetailsProduitProducteur', 'QuantiteProduitProducteur', 'IdProduitProduitProducteur', 'ImageProduitProducteur'
            ]);
            $idProducteur = $_SESSION['user']['IdRole'];

            if ($datas !== false) {

                // Vérifie si un fichier d'image a été téléchargé
                if (isset($_FILES["ImageProduitProducteur"]) && $_FILES["ImageProduitProducteur"]["error"] == 0) {
                    // Gérez le téléchargement de l'image ici
                    $file_size = $_FILES["ImageProduitProducteur"]["size"];
                    $file_type = $_FILES["ImageProduitProducteur"]["type"];

                    if ($file_size < 1000000) { // 1 MB
                        if ($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/webp") {
                            $extension = pathinfo($_FILES['ImageProduitProducteur']['name'], PATHINFO_EXTENSION);
                            $new_filename = uniqid() . "." . $extension;
                            $upload_path = "assets/images/" . $new_filename;
                            if (move_uploaded_file($_FILES["ImageProduitProducteur"]["tmp_name"], $upload_path)) {
                                // Stockez le chemin de l'image dans la base de données
                                // Assurez-vous d'ajuster votre modèle pour inclure cette colonne
                            }
                        }
                    }
                } else {
                    $upload_path = "assets/images/fruit.jpg";
                }
                // Crée un modèle ProduitProducteur
                $ProduitProducteur = new ProduitProducteurModel();
                // Remplit les propriétés du modèle avec les données du formulaire
                $ProduitProducteur->IdProducteurProduitProducteur = $idProducteur;
                $ProduitProducteur->IdProduitProduitProducteur  = $datas['IdProduitProduitProducteur'];
                $ProduitProducteur->DesignationProduitProducteur = htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES);
                $ProduitProducteur->PrixProduitProducteur = $datas['PrixProduitProducteur'];
                $ProduitProducteur->DetailsProduitProducteur = $datas['DetailsProduitProducteur'];
                $ProduitProducteur->QuantiteProduitProducteur = $datas['QuantiteProduitProducteur'];
                $ProduitProducteur->ImageProduitProducteur = $upload_path;

                // Enregistre les données dans la base de données
                $IdProduitProducteur = $ProduitProducteur->Save();

                $Demandes = new DemandesModel();
                $Demandes->IdProducteurDemande = $idProducteur;
                $Demandes->IdProduitProducteurDemande = $IdProduitProducteur;
                $Demandes->ObjetDemande = 'Ajout';
                $Demandes->PrixProposeDemande = $datas['PrixProduitProducteur'];
                $Demandes->DesignationProduitDemande = htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES);
                $Demandes->MotifDemande = "Le producteur " . $_SESSION['user']['Username'] . " souhaite ajouter le produit " . htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES) .
                    " au prix de " . $datas['PrixProduitProducteur'];
                $Demandes->Save();


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
        $info = (isset($_GET['info'])) ? $_GET['info'] : '';
        // Initialise la vue avec des données
        ViewController::Init('smarty');
        ViewController::Set('info', $info);

        ViewController::Set('title', 'Gestion de produit');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('AllProducts', $allProducts);
        ViewController::Display('AddProductProducteurView');
    }

    public function ProductList(): void
    {
        $this->connectCheck('user', 'Producteur');
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
            foreach ($_POST['produit'] as $IdProduitProducteur => $datas) {
                // Valide les données du formulaire
                $datas = $this->validate($datas, ['DesignationProduitProducteur', 'PrixProduitProducteur', 'QuantiteProduitProducteur', 'DetailsProduitProducteur']);
                if ($datas !== false) {
                    // Crée un modèle ProduitProducteur et effectue la mise à jour
                    $ProduitProducteurModel = new ProduitProducteurModel();
                    $ProduitProducteurModel->producteurProduitUpdate($datas, $idProducteur, $IdProduitProducteur);

                    $demandes = new DemandesModel();
                    $demandes->IdProducteurDemande = $idProducteur;
                    $demandes->IdProduitProducteurDemande = $IdProduitProducteur;
                    $demandes->ObjetDemande = 'Prix';
                    $demandes->DesignationProduitDemande = htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES);
                    $demandes->PrixProposeDemande = $datas['PrixProduitProducteur'];
                    $demandes->MotifDemande = "Le producteur " . $_SESSION['user']['Username'] . " souhaite modifié le prix de " . htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES) .
                        " au prix de " . $datas['PrixProduitProducteur'];
                    $demandes->Save();
                }
            }
        }
    }

    private function DeleteProductProducteur(): void
    {
        // Vérifie si un formulaire de suppression a été soumis

        if (isset($_POST['deleteProduit']) && is_array($_POST['deleteProduit'])) {
            $Produit = new ProduitProducteurModel();
            // Parcourt les produits à supprimer et les supprime un par un
            foreach ($_POST['deleteProduit'] as $IdProduitProducteur => $value) {
                // Supprime le produit correspondant
                $ProduitInfo = $Produit->getOneProduitProducteur($IdProduitProducteur);

                $imagePath = $ProduitInfo['ImageProduitProducteur'];

                // Supprime le fichier image associé
                if (file_exists($imagePath)) {
                    unlink(DIR_PUBLIC . $imagePath);
                }
                // Supprime le produit correspondant
                $Produit->producteurProduitDelete($IdProduitProducteur);
            }
        }
    }
}



// Récupéré l'id de l'élement avec find One par exemple.