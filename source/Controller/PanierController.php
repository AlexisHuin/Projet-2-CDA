<?php
namespace Controller;

use Controller\HomeController;
use Model\ProduitModel;
use Model\PanierModel;
use Controller\ExceptionHandler;
use Controller\ViewController;

class Panier extends HomeController
{
    public function displayPanier(array $params)
    {
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        ViewController::init("Panier");
        $panier = self::getPanier();
        $produits = [];
        $prd = new ProduitModel();
        foreach ($panier as $id => $quantitearr) {
            $produits[$id] = $prd->getProduitsInfos($id);
            $produits[$id]["Quantite"] = $quantitearr;
        }
        ViewController::set("produits", $produits);
        if (isset($_GET["err"])) {
            ViewController::set("err", $_GET["err"]);
        }
        ViewController::display("Panier");
    }

    public function ajoutProduitPanier()
    {
        if (!$this->validate_array_format(["IdProduit", "Quantité"], $_POST) || (intval($_POST["Quantité"]) > 10 && intval($_POST["Quantité"]) < 1)) {
            echo "Paramètres incorrects";
            return;
        }
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        array_push($_SESSION['panier'], ["IdProduitProducteur" => $_POST["IdProduitProducteur"], "Quantite" => $_POST["Quantité"], "Prix" => $_POST['Prix'], "IdAdherent" => $_SESSION['user']['IdRole']]);
        $panier = new PanierModel();

        $prixTotalLignePanier = $_POST['Quantite'] * $_POST['Prix'];

        $panier->IdProduitProducteurPanier = $_POST['IdProduitProducteur'];
        $panier->QuantitePanier = $_POST['Quantite'];
        $panier->PrixPanier = $prixTotalLignePanier;
        $panier->IdAdherentsPanier = $_SESSION['user']['IdRole'];
    
        exit();
    }

    public function supprimerProduitPanier()
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

    static public function viderPanier()
    {
        unset($_SESSION["panier"]);
        header("Location: /panier");
        exit();
    }

    public function validerPanier(array $args, bool $redirect = true)
    {
        $this->connectCheck('user', 'Adherent'); // Assurez-vous que cette méthode est correcte
        try {
            foreach (self::getPanier() as $id => $q) {
                $prop = new Panier(); // À vérifier si c'est bien nécessaire
                if ($prop->getQuantiteProduit($id) < $q) {
                    header("Location: /panier?err=" . htmlspecialchars("Un produit n'est plus disponible."));
                    exit();
                }
            }
        } catch (ExceptionHandler $e) {
            header("Location: /panier?err=" . htmlspecialchars($e->getMessage()));
            exit();
        }
        if ($redirect) {
            header("Location: /panier/prepaiement");
            exit();
        }
    }

    public function displayPrepaiementPanier()
    {
        self::validerPanier([], false);
        ViewController::init("Pré-paiement");
        $produits = [];
        $prod = new ProduitModel();
        foreach (self::getPanier() as $id => $q) {
            $produits[] = $prod->getProduits($id);
        }
        ViewController::set("produits", $produits);
        ViewController::display("PanierPrepaiement");
    }
}
