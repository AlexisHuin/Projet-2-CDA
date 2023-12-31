<?php

namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\ProduitProducteurModel;
use Model\NotificationsModel;

use DateTime;
use Model\BundleModel;
use Model\PanierModel;
use Model\CommandesModel;
use Model\FactureModel;
use Model\AdherentModel;

class HomeController extends MainController
{
    public function Index()
    {
        $ProduitModel = new ProduitModel();
        $CategorieModel = new CategorieModel();

        $allProducts = $ProduitModel->getProduits();
        $categories = $CategorieModel->Find();

        $AllBundles = ProducteurController::listBundle(true);

        $ProduitsBundle = [];
        if ($AllBundles) {
            foreach ($AllBundles as $bundle) {
                $ProduitsBundle[] = ProducteurController::listProduitsBundle($bundle);
            }
        }

        //TODO Verif sécurité
        if (isset($_POST['Acheter'])) {
            $this->buyBundle();
        }

        $sortedProducts = $this->sortBySaison($allProducts);

        ViewController::Set('title', 'Home');
        ViewController::Set('AllBundles', $AllBundles);
        ViewController::Set('ProduitsBundle', $ProduitsBundle);
        ViewController::Set('products', $sortedProducts);
        ViewController::Set('categories', $categories);
        ViewController::Display('HomeView');
    }

    public function DescriptifProduit($id)
    {
        //TODO Continuer commentaires
        //* Vérification si l'utilisateur est connecté

        $errors = [];
        if (isset($_POST['Add'])) {
            $this->connectCheck('user', 'Adherent', "/User");

            //* Check si les champs sont valides
            $datas = $this->validate($_POST, ["Quantite", "Id", "IdProd"]);

            if ($datas) {
                $ProduitProducteur = new ProduitProducteurModel();
                $ProduitProducteur->IdProduitProducteur = $datas['Id'];
                $ProduitEnCours = $ProduitProducteur->Find("QuantiteProduitProducteur, PrixProduitProducteur", 'Fetch');

                $datasProducteur = [
                    "QuantiteTotal" => $ProduitEnCours['QuantiteProduitProducteur'],
                    "Prix" => $ProduitEnCours['PrixProduitProducteur']
                ];
                $datas = array_merge($datas, $datasProducteur);

                $panierModel = new PanierModel();
                //*  Check si quantité demandée et plus élevée que la quantité proposée par le producteur
                if ($datas['Quantite'] > $datas['QuantiteTotal'] || $datas['Quantite'] <= 0) {
                    ExceptionHandler::SetUserError("Quantité invalide.");
                }
                //*  check si il existe au moins une ligne dans le panier
                else if (isset($_SESSION['panier'][0])) {
                    //*  Initialisation d'un compteur de boucle
                    $Line = 0;
                    //* Itérations dans la session panier
                    foreach ($_SESSION['panier'] as $panier) {
                        //* Check si l'id du produit dans la ligne actuelle du panier correspont à celui que l'on essaie d'insérer
                        if ($panier['Produit'] == $datas['Id']) {
                            if (($panier['Quantite'] + $datas['Quantite']) > $datas['QuantiteTotal']) {
                                ExceptionHandler::SetUserError("Quantité dans le panier supérieure à la quantité totale disponible.");
                            } else {
                                $_SESSION['panier'][$Line]['Quantite'] = $panier['Quantite'] + $datas['Quantite'];
                                $panierModel->QuantitePanier = $_SESSION['panier'][$Line]['Quantite'];
                                $panierModel->Where($_SESSION['panier'][$Line]['IdLigne']);

                                $panierModel->Update();

                                header('Refresh:0.01;' . $_SERVER['REQUEST_URI']);
                                exit();
                            }
                        }
                        $Line++;
                    }
                }

                $errors = ExceptionHandler::GetUserError();
                if (count($errors) == 0) {
                    $panierModel->ProduitPanier = $datas['Id'];
                    $panierModel->QuantitePanier = $datas['Quantite'];
                    $panierModel->PrixPanier = ($datas['Prix'] * $datas['Quantite']);
                    $panierModel->IdProducteurProduitPanier = $datas['IdProd'];
                    $panierModel->IdAdherentsPanier = $_SESSION['user']['IdRole'];
                    $LigneId = $panierModel->Save();

                    $LignePanier = [
                        "IdLigne" => $LigneId,
                        "Produit" => $panierModel->ProduitPanier,
                        "Quantite" => $panierModel->QuantitePanier,
                        "Prix" => $panierModel->PrixPanier,
                        "Producteur" => $datas['IdProd']
                    ];

                    array_push($_SESSION['panier'], $LignePanier);

                    header('Refresh:0.01;' . $_SERVER['REQUEST_URI']);
                    exit();
                }
            }
        }

        $ProduitModel = new ProduitModel();
        $produitProducteurModel = new ProduitProducteurModel();

        $ProduitModel->IdProduit = $id['id'];
        $Produit = $ProduitModel->Find('DesignationProduit', 'Fetch');

        $produitProducteurs = $produitProducteurModel->getProduitProducteur($id['id'], false, true);

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        ViewController::Set('title', $Produit['DesignationProduit']);
        ViewController::Set('panier', $_SESSION['panier']);
        ViewController::Set('Id', $id['id']);
        ViewController::Set('produitProducteur', $produitProducteurs);
        ViewController::Set('produit', $Produit);
        ViewController::Set('errors', $errors);
        ViewController::Display('DescriptifProduitView');
    }

    private function sortBySaison($datas)
    {
        $nowNoFormat = new DateTime();
        $now = $nowNoFormat->format('m-d');

        $produits = array();
        for ($i = 0; $i < count($datas); $i++) {
            $debutNoFormat = new DateTime($datas[$i]['DateDebutSaison']);
            $finNoFormat = new DateTime($datas[$i]['DateFinSaison']);

            $debut = $debutNoFormat->format('m-d');
            $fin = $finNoFormat->format('m-d');

            if ($now >= $debut && $now <= $fin) {
                $produits[] = [
                    "IdProduit" => $datas[$i]['IdProduit'],
                    "DesignationProduit" => $datas[$i]['DesignationProduit'],
                    "IdCategorie" => $datas[$i]['IdCategorieProduit'],
                    "DesignationCategorie" => $datas[$i]['DesignationCategorie'],
                    "PhotoProduit" => $datas[$i]['PhotoProduit'],
                ];
            }
        }

        return $produits;
    }

    private function buyBundle(): void
    {
        $Bundle = new BundleModel();
        $Bundle->IdBundle = $_POST['Id'];
        $Purchase = $Bundle->Find('*', 'Fetch');
        $Bundle->Delete();

        $commande = new CommandesModel();
        $facture = new FactureModel();
        $adherent = new AdherentModel();
        $produitProducteur = new ProduitProducteurModel();
        $notifications = new NotificationsModel();

        //* Traitements table Commandes
        $commande->TotalCommande = $Purchase['PrixBundle'];
        $commande->ProduitsCommande = $Purchase['IdProduitsBundle'];
        $commande->QuantitesCommande = $Purchase['QuantiteProduitsBundle'];
        $commande->ProducteursCommande = $Purchase['IdProducteurBundle'];
        $commande->IdAdherentCommande = $_SESSION['user']['IdRole'];
        $commande->Save();

        //* Traitements table Facture
        $adherent->IdAdherent = $_SESSION['user']['IdRole'];
        $totalActuel = $adherent->Find('DepenseAdherent', 'Fetch');

        $facture->MontantFacture = $totalActuel['DepenseAdherent'] + $Purchase['PrixBundle'];

        $facture->Where([$_SESSION['user']['IdRole'], "'En cours'"], ['idAdherent', 'datePrelevement']);
        $facture->Update();

        //* Traitement table Adherent
        $adherent->DepenseAdherent = $totalActuel['DepenseAdherent'] + $Purchase['PrixBundle'];

        $adherent->Where($_SESSION['user']['IdRole']);
        $adherent->Update();

        $notifications->IdDestinataireNotification = $_SESSION['user']['Id'];
        $notifications->DateEnvoiNotification = date('d-M-Y H:i');
        $notifications->MotifNotification = "Votre commande a bien été prise en compte, vous disposez à présent de 2 jours pour venir la récupérer, sans quoi, la commande sera annulée et vous serez tout de même débité.";
        $notifications->Save();

        header('Refresh:1;/');
        echo "Commande validé avec succès !";
        exit();
    }
}
