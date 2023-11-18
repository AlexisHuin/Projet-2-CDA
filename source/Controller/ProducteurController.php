<?php

namespace Controller;

use Model\ProduitModel;
use Model\ProduitProducteurModel;
use Model\DemandesModel;
use Controller\ViewController;
use Controller\ExceptionHandler;
use Model\ProducteurModel;
use Model\BundleModel;

class ProducteurController extends UserController
{

    //* Fonction qui permet au producteur log depuis la page profil d'ajouter de nouveaux produits
    //* Les images sont vérifié suivant leur type, taille, le chemin pour l'image est stocké en base de données, et l'image sauvegarder 
    //* dans le fichier assets/images
    //* La fonction dans un deuxiéme temps permet d'envoyé une demande de validation a l'admin, qui permet au producteur depuis la page profil
    //* de voir les produits en attente, et ce validé. 


    public function AddProduct(): void
    {
        $this->connectCheck('user', 'Producteur');

        $errors = [];

        //* Vérifie si le formulaire d'ajout a été soumis
        if (isset($_POST['Ajouter'])) {
            //* Valide les données du formulaire
            $datas = $this->validate($_POST, [
                'DesignationProduitProducteur', 'PrixProduitProducteur',
                'DetailsProduitProducteur', 'QuantiteProduitProducteur', 'IdProduitProduitProducteur'
            ]);
            $idProducteur = $_SESSION['user']['IdRole'];

            if ($datas !== false) {

                //* Vérifie si un fichier d'image a été téléchargé
                if (isset($_FILES["ImageProduitProducteur"]) && $_FILES["ImageProduitProducteur"]["error"] == 0) {
                    //* Gérez le téléchargement de l'image ici
                    $file_size = $_FILES["ImageProduitProducteur"]["size"];
                    $file_type = $_FILES["ImageProduitProducteur"]["type"];

                    if ($file_size < 1000000) { // 1 MB
                        if ($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/webp") {
                            $extension = pathinfo($_FILES['ImageProduitProducteur']['name'], PATHINFO_EXTENSION);
                            $new_filename = uniqid() . "." . $extension;
                            $upload_path = "assets/images/" . $new_filename;
                            if (move_uploaded_file($_FILES["ImageProduitProducteur"]["tmp_name"], $upload_path)) {
                                //* Stockez le chemin de l'image dans la base de données
                                //* Assurez-vous d'ajuster votre modèle pour inclure cette colonne
                            }
                        }
                    }
                } else {
                    $upload_path = "assets/images/fruit.jpg";
                }

                if ($datas['QuantiteProduitProducteur'] < 10) {
                    ExceptionHandler::SetUserError('Quantité trop faible pour la mise en vente');
                }

                if ($datas['PrixProduitProducteur'] <= 0) {
                    ExceptionHandler::SetUserError('Veuillez entrer un prix réel');
                }

                $errors = ExceptionHandler::GetUserError();

                if (count($errors) == 0) {
                    //* Crée un modèle ProduitProducteur
                    $ProduitProducteur = new ProduitProducteurModel();
                    //* Remplit les propriétés du modèle avec les données du formulaire
                    $ProduitProducteur->IdProducteurProduitProducteur = $idProducteur;
                    $ProduitProducteur->IdProduitProduitProducteur  = $datas['IdProduitProduitProducteur'];
                    $ProduitProducteur->DesignationProduitProducteur = htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES);
                    $ProduitProducteur->PrixProduitProducteur = $datas['PrixProduitProducteur'];
                    $ProduitProducteur->DetailsProduitProducteur = $datas['DetailsProduitProducteur'];
                    $ProduitProducteur->QuantiteProduitProducteur = $datas['QuantiteProduitProducteur'];
                    $ProduitProducteur->ImageProduitProducteur = $upload_path;

                    //* Enregistre les données dans la base de données
                    $IdProduitProducteur = $ProduitProducteur->Save();

                    $Demandes = new DemandesModel();
                    $Demandes->IdUserDemande = $_SESSION['user']['IdRole'];
                    $Demandes->IdProduitProducteurDemande = $IdProduitProducteur;
                    $Demandes->ObjetDemande = 'Ajout';
                    $Demandes->PrixProposeDemande = $datas['PrixProduitProducteur'];
                    $Demandes->DesignationProduitDemande = htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES);
                    $Demandes->MotifDemande = "Le producteur " . $_SESSION['user']['Username'] . " souhaite ajouter le produit " . htmlentities($datas['DesignationProduitProducteur'], ENT_QUOTES) .
                        " au prix de " . $datas['PrixProduitProducteur'];
                    $Demandes->Save();


                    //* Redirige l'utilisateur avec un message de succès
                    header('location: /User/AddProduct?info=Produit ajouté avec succès');
                    exit();
                }
            } else {
                //* Gère les erreurs de validation
                ExceptionHandler::SetUserError("Erreur");
                $errors = ExceptionHandler::GetUserError();
            }
        }

        //* Récupère la liste de tous les produits depuis la base de données
        $Produits = new ProduitModel;
        $allProducts = $Produits->getAllProduitsInfos();
        usort($allProducts, function ($a, $b) {
            return strcmp($a['DesignationProduit'], $b['DesignationProduit']);
        });
        $info = (isset($_GET['info'])) ? $_GET['info'] : '';

        //* Initialise la vue avec des données
        ViewController::Set('info', $info);
        ViewController::Set('errors', $errors);
        ViewController::Set('title', 'Gestion de produit');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('AllProducts', $allProducts);
        ViewController::Display('AddProductProducteurView');
    }


    //* fonction pour listé la liste des produits du producteurs, qui s'adapte au formulaire de suppresion, et d'update.
    public function ProductList(): void
    {
        $this->connectCheck('user', 'Producteur', '/User');

        $AllBundles = self::listBundle();
        $errors = [];

        $ProduitsBundle = [];
        if ($AllBundles) {
            foreach ($AllBundles as $bundle) {
                $ProduitsBundle[] = self::listProduitsBundle($bundle);
            }
        }

        $this->connectCheck('user', 'Producteur');
        //* Vérifie si l'utilisateur a soumis un formulaire de suppression
        if (isset($_POST['delete'])) {
            if (isset($_POST['deleteProduit'])) {
                $this->DeleteProductProducteur();
            } else {
                ExceptionHandler::SetUserError('Veuillez selectionner au moins 1 produit');
                $errors = ExceptionHandler::GetUserError();
            }
        }

        //* Vérifie si l'utilisateur a soumis un formulaire de mise à jour
        if (isset($_POST['update'])) {
            if (isset($_POST['MajPrix'])) {
                $errors = $this->UpdateProductProducteur($_POST);
            } else {
                ExceptionHandler::SetUserError('Veuillez selectionner au moins 1 produit');
                $errors = ExceptionHandler::GetUserError();
            }
        }

        //* Crée une instance de ProduitProducteurModel pour gérer les produits du producteur
        $Produits = new ProduitProducteurModel();
        $AllProduits = $Produits->getProduitProducteur($_SESSION['user']['IdRole'], true);

        ViewController::Set('title', 'Mes produits');
        ViewController::Set('errors', $errors);
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('AllBundles', $AllBundles);
        ViewController::Set('ProduitsBundle', $ProduitsBundle);
        ViewController::Set('AllProduits', $AllProduits);
        ViewCOntroller::Display('ProduitProducteurListView');
    }

    //* function pour mettre a jour les produits du producteurs, uniquement le prix, elle gére également la demande de modification pour emettre
    //* a l'admin

    private function UpdateProductProducteur($post): bool|array
    {
        //* Récupère l'ID du producteur à partir de la session
        $idProducteur = $_SESSION['user']['IdRole'];

        //* Vérifie si un tableau de produits à mettre à jour a été soumis
        $datas = $this->validate($post, ['MajPrix', 'Prix']);
        if ($datas !== false) {
            for ($i = 0; $i < count($_POST['MajPrix']); $i++) {
                //* Valide les données du formulaire
                //* Crée un modèle ProduitProducteur et effectue la mise à jour

                if ($datas['Prix'][$i] <= 0) {
                    ExceptionHandler::SetUserError('Veuillez entrer un prix réel');
                }

                $errors = ExceptionHandler::GetUserError();

                if (count($errors) == 0) {
                    $ProduitProducteurModel = new ProduitProducteurModel();
                    $ProduitProducteurModel->IdProduitProducteur = $datas['MajPrix'][$i];
                    $ProduitProducteur = $ProduitProducteurModel->Find('*', 'Fetch');

                    if ($ProduitProducteur['PrixProduitProducteur'] == $datas['Prix'][$i]) {
                        ExceptionHandler::SetUserError('Veuillez entrer un prix différent de l\'ancien');
                        $errors = ExceptionHandler::GetUserError();
                        return $errors;
                    }

                    //* On retire l'ID afin de ne pas l'inclure dans la requete;
                    unset($ProduitProducteurModel->IdProduitProducteur);

                    $ProduitProducteurModel->PrixProduitProducteur = $datas['Prix'][$i];
                    $ProduitProducteurModel->IsValidateProduitProducteur = 0;
                    $ProduitProducteurModel->Where($datas['MajPrix'][$i]);
                    $ProduitProducteurModel->Update();

                    $demandes = new DemandesModel();
                    $demandes->IdUserDemande = $_SESSION['user']['IdRole'];
                    $demandes->IdProduitProducteurDemande = $_POST['MajPrix'][$i];
                    $demandes->ObjetDemande = 'Prix';
                    $demandes->DesignationProduitDemande = htmlentities($ProduitProducteur['DesignationProduitProducteur'], ENT_QUOTES);
                    $demandes->PrixProposeDemande = $datas['Prix'][$i];
                    $demandes->MotifDemande = "Le producteur " . $_SESSION['user']['Username'] . " souhaite modifié le prix de " . htmlentities($ProduitProducteur['DesignationProduitProducteur'], ENT_QUOTES) .
                        " au prix de " . $datas['Prix'][$i];
                    $demandes->Save();
                } else {
                    return $errors;
                }
            }
            header('Location: /User/ProductList');
            exit();
            return true;
        }
    }

    // * function qui permet de supprimer un ou des produits producteur par le producteurs.

    private function DeleteProductProducteur(): void
    {
        // * Vérifie si un formulaire de suppression a été soumis

        $Produit = new ProduitProducteurModel();
        // Parcourt les produits à supprimer et les supprime un par un
        foreach ($_POST['deleteProduit'] as $IdProduitProducteur) {

            // ? Pour le futur, créer un controller chargé de gérer les suppressions en fonction des contraintes de FK plutôt que de recopier;
            // NOTICE Voir admin pour commentaires

            $demandes = new DemandesModel();
            $demandes->IdProduitProducteurDemande = $IdProduitProducteur;

            $result = $demandes->Find('IdDemande');
            if ($result) {
                $demandes->Delete();
            }
            $Bundle = new BundleModel();

            if (isset($_POST['Produit'])) {
                $IdProduitsBundle = $Bundle->Find("IdProduitsBundle, IdBundle");
                $IdProduitsBundleArr = [];

                foreach ($IdProduitsBundle as $ProduitsBundle) {
                    array_push($IdProduitsBundleArr, explode(',', $ProduitsBundle['IdProduitsBundle']));
                }

                foreach ($IdProduitsBundleArr as $key => $Arrays) {
                    foreach ($Arrays as $Id) {
                        if ($Id === $IdProduitProducteur) {
                            $Bundle->IdBundle = $IdProduitsBundle[$key]['IdBundle'];
                            $Bundle->Delete();
                            break;
                        }
                    }
                }

                //* Supprime le produit correspondant
                $Produit->IdProduitProducteur = $IdProduitProducteur;
                $ProduitInfo = $Produit->Find('ImageProduitProducteur', 'Fetch');
                $imagePath = $ProduitInfo['ImageProduitProducteur'];

                //* Supprime le fichier image associé
                if (file_exists($imagePath) && $imagePath !== "assets/images/fruit.jpg") {
                    unlink(DIR_PUBLIC . $imagePath);
                }
                //* Supprime le produit correspondant

                $Produit->Delete();
            } else if (isset($_POST['Bundle'])) {

                $Bundle->IdBundle = $IdProduitProducteur;
                $ProduitsBundle = $Bundle->Find("IdProduitsBundle, QuantiteProduitsBundle", 'Fetch');

                $IdProduitsArr = [];
                $QuantitesArr = [];
                $NbProduitsBundle = count(explode(",", $ProduitsBundle['IdProduitsBundle']));

                //! Magie noire
                for ($j = 0; $j < $NbProduitsBundle; $j++) {
                    for ($i = 0; $i < count($ProduitsBundle); $i++) {
                        $IdProduitsArr = explode(",", $ProduitsBundle['IdProduitsBundle']);
                        $QuantitesArr = explode(",", $ProduitsBundle['QuantiteProduitsBundle']);
                    }

                    if(!isset($Produit)){
                        $Produit = new ProduitProducteurModel();
                    }

                    $Produit->IdProduitProducteur = $IdProduitsArr[$j];
                    $qt = $Produit->Find('QuantiteProduitProducteur', 'Fetch');

                    $Produit->QuantiteProduitProducteur = $qt['QuantiteProduitProducteur'] + $QuantitesArr[$j];
                    $Produit->Where($IdProduitsArr[$j]);
                    $Produit->Update();

                    unset($Produit);
                }

                $Bundle->Delete();
            }
        }

        header('Location: /User/ProductList');
        exit();
    }

    public static function listBundle(bool $isHomePage = false): string|object|array
    {
        $producteurs = new ProducteurModel();
        if(!$isHomePage){
            $producteurs->IdProducteur = $_SESSION['user']['IdRole'];
        }
        $producteurs->Join(['IdProducteur'], ['Bundle' => 'IdProducteurBundle']);
        $AllBundles = $producteurs->Find('*', 'FetchAll');

        return $AllBundles;
    }

    public static function listProduitsBundle(array $produits): object|array
    {

        $produitProducteur = new ProduitProducteurModel();
        $produitProducteur->IdProduitProducteur = $produits['IdProduitsBundle'];
        $Produits = $produitProducteur->Find('DesignationProduitProducteur', "FetchAll", true);

        return $Produits;
    }
}
