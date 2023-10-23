<?php

namespace Controller;

use Controller\ViewController;
use Model\ProduitModel;
use Model\CategorieModel;
use Model\SaisonModel;
use DateTime;

class HomeController extends MainController
{
    public function Index(): void
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('h1', 'Smarty : Hello World !');

        $ProduitModel = new ProduitModel();
        ViewController::Set('products', $this->FilterBySeason($ProduitModel->getProduits()));


        $CategorieModel = new CategorieModel();
        ViewController::Set('categories', $CategorieModel->getCategories());

        $SaisonModel = new SaisonModel();
        ViewController::Set('saisons', $SaisonModel->getSaisons());

        ViewController::Display('HomeView');
    }

    public function DescriptifProduit($params = []): void
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Descriptif-Produit');
        $ProduitModel       = new ProduitModel();
        $Produit            = $ProduitModel->DescriptifProduit($params['id']);

        ViewController::Set('product',$Produit);

        ViewController::Display('DescriptifProduit');
    }

    private function FilterBySeason(array $produitsPasSaison): array
    {

        $nowNoFormat = new DateTime();
        $now = $nowNoFormat->format('m-d');

        $produits = array();
        for ($i = 0; $i < count($produitsPasSaison); $i++) {
            $debutNoFormat = new DateTime($produitsPasSaison[$i]['DateDebutSaison']);
            $finNoFormat = new DateTime($produitsPasSaison[$i]['DateFinSaison']);

            $debut = $debutNoFormat->format('m-d');
            $fin = $finNoFormat->format('m-d');

            if ($now >= $debut && $now <= $fin) {
                $produits[] = [
                    "DesignationProduit" => $produitsPasSaison[$i]['DesignationProduit'],
                    "DesignationCategorie" => $produitsPasSaison[$i]['DesignationCategorie'],
                    "IdProduit" => $produitsPasSaison[$i]['IdProduit'],
                    "DesignationProduit" => $produitsPasSaison[$i]['DesignationProduit']
                ];
            }
        }
        return $produits;
    }
}
