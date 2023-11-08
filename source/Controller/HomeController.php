<?php

namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\ProduitProducteurModel;
use Model\NotificationsModel;

use DateTime;

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
        ViewController::Set('products', $sortedProducts);
        ViewController::Set('categories', $categories);
        ViewController::Display('HomeView');
    }

    public function DescriptifProduit($params = [])
    {

        $ProduitModel = new ProduitModel();
        $Produit = $ProduitModel->DescriptifProduit($params['id']);
        $produitProducteurModel = new ProduitProducteurModel();
        $produitProducteurs = $produitProducteurModel->getProduitProducteur($params['id']);;
        ViewController::Set('title', 'Home');
        ViewController::Set('produit', $produitProducteurs);
        ViewController::Set('produitProducteur', $Produit);
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
