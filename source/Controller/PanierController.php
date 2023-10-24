<?php
namespace Controller;

use Controller\View;
use Exception;
use Model\Produit;
use Model\ProduitModel;
use Model\Proposition;

class Panier extends HomeController
{
    public function DisplayPanier(array $params)
    {
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        ViewController::Init("Panier");
        $panier = Panier::getPanier();
        $produits = [];
        $prd = new ProduitModel();
        foreach ($panier as $id => $quantityarr) {
            $produits[$id] = $prd->getAllProduitsInfos($id);
            $produits[$id]["Quantity"] = $quantityarr;
        }
        ViewController::Set("produits", $produits);
        if (isset($_GET["err"]))
            ViewController::Set("err", $_GET["err"]);
        ViewController::Display("Panier");
    }

    public function AjoutProduitPanier()
    {
        if (!$this->validate_array_format(["id_produit", "quantity"], $_POST) || (intval($_POST["quantity"]) > 10 && intval($_POST["quantity"]) < 1)) {
            echo "Paramètres incorrects";
            return;
        }
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        $_SESSION["panier"][$_POST["id_produit"]] = $_POST["quantity"];
        $prd = new ProduitModel();
        $typeid = $prd->getProduits($_POST["IdProduits"])["CategorieProduit"];
        header("Location: /produits/" . $typeid);
        exit();
    }

    public function SupprimerProduitPanier()
    {
        if (!$this->validate_array_format(["IdProduit"], $_POST)) {
            echo "Paramètres incorrects";
            return;
        }
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        unset($_SESSION["panier"][$_POST["IdProduit"]]);
        header("Location: /panier");
        exit();
    }

    static public function getPanier()
    {
        return $_SESSION["panier"];
    }
    static public function ViderPanier()
    {
        unset($_SESSION["panier"]);
        header("Location: /panier");
        exit();
    }

    static function ValiderPanier(array $args, bool $redirect = true)
    {
        if (Conne::connectedAs() !== "adh") {
            header("Location: /");
            exit();
        }
        $prop = new Proposition();
        try {
            foreach (Panier::getPanier() as $id => $q) {
                if ($prop->getQuantiteProduit($id) < $q) {
                    header("Location: /panier?err=" . htmlspecialchars("Un produit n'est plus disponible."));
                    exit();
                }
            }
        } catch (Exception $e) {
            header("Location: /panier?err=" . htmlspecialchars($e->getMessage()));
            exit();
        }
        if ($redirect) {
            header("Location: /panier/prepaiement");
            exit();
        }
    }

    function DisplayPrepaiementPanier()
    {
        Panier::validerPanier([], false);
        ViewController::Init("Pré-paiement");
        $produits = [];
        $prod = new ProduitModel();
        foreach (Panier::getPanier() as $id => $q) {
            $produits[] = $prod->getProduit($id);
        }
        ViewController::Set("produits", $produits);
        ViewController::Display("PanierPrepaiement");
    }
}