<?php

namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\ProduitProducteurModel;
use Model\NotificationsModel;

use DateTime;
use Model\PanierModel;

class HomeController extends MainController
{
    public function Index()
    {

        $ProduitModel = new ProduitModel();
        $CategorieModel = new CategorieModel();

        $allProducts = $ProduitModel->getProduits();
        $categories = $CategorieModel->Find();

        $sortedProducts = $this->sortBySaison($allProducts);

        ViewController::Set('title', 'Home');
        ViewController::Set('URI', $_SERVER['REQUEST_URI']);
        ViewController::Set('products', $sortedProducts);
        ViewController::Set('categories', $categories);
        ViewController::Display('HomeView');
    }

    public function DescriptifProduit($id)
    {
        if (isset($_POST['Add'])) {
            $this->connectCheck('user', 'Adherent', "User/");
            $datas = $this->validate($_POST, ["Prix", "Description", "QuantiteTotal", "Quantite"]);

            if ($datas) {

                if ($datas['Quantite'] > $datas['QuantiteTotal'] || $datas['Quantite'] <= 0) {
                    ExceptionHandler::SetUserError("Quantité invalide.");
                } else if (isset($_SESSION['panier'][0])) {
                    foreach ($_SESSION['panier'] as $panier) {
                        if ($panier['Produit'] == $datas['Id']) {
                            if (($panier['Quantite'] + $datas['Quantite']) > $datas['QuantiteTotal']) {
                                ExceptionHandler::SetUserError("Quantité dans le panier supérieure à la quantité totale disponible.");
                            } else {
                                break;
                            }
                        }
                    }
                }

                $errors = ExceptionHandler::GetUserError();
                if (count($errors) == 0) {
                    $panierModel = new PanierModel();
                    $panierModel->ProduitPanier = $datas['Id'];
                    $panierModel->QuantitePanier = $datas['Quantite'];
                    $panierModel->PrixPanier = ($datas['Prix'] * $datas['Quantite']);
                    $panierModel->IdAdherentsPanier = $_SESSION['user']['IdRole'];
                    $LigneId = $panierModel->Save();

                    $LignePanier = [
                        "IdLigne" => $LigneId,
                        "Produit" => $panierModel->ProduitPanier,
                        "Quantite" => $panierModel->QuantitePanier,
                        "Prix" => $panierModel->PrixPanier
                    ];

                    array_push($_SESSION['panier'], $LignePanier);

                    header('Refresh:0.01;' . $_SERVER['REQUEST_URI']);
                    exit();
                }
            }
            var_dump($errors);
        }

        $ProduitModel = new ProduitModel();
        $produitProducteurModel = new ProduitProducteurModel();

        $ProduitModel->IdProduit = $id['id'];
        $Produit = $ProduitModel->Find('DesignationProduit', 'Fetch');

        $produitProducteurs = $produitProducteurModel->getProduitProducteur($id['id'], true);


        ViewController::Set('title', 'Home');
        ViewController::Set('URI', $_SERVER['REQUEST_URI']);
        ViewController::Set('Id', $id['id']);
        ViewController::Set('produitProducteur', $produitProducteurs);
        ViewController::Set('produit', $Produit);
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
}
