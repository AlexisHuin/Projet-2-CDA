<?php
namespace Controller;


use Controller\SessionController;
use Controller\ViewController;
use Model\ProduitModel;
use Model\ProduitProducteurModel;

class PanierController extends HomeController
{
    public function afficherPanier(array $params)
    {
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        
        $panier = PanierController::getPanier();
        $produits = [];
        $prd = new ProduitProducteurModel();
        foreach ($panier as $id => $Quantite) {
            $datas = $prd->getProduitsProducteur($id);
            if($datas !== false && !empty($datas))
            {
                $produits[$id] = $datas;
                $produits[$id]["Quantite"] = $Quantite;
            }
        }

        if (isset($_GET["err"])) {
           
        }
        ViewController::init("smarty");
        ViewController::set("produits", $produits);
        ViewController::display("PanierView");
    }

    public function ajouterProduitPanier()
    {
        if (!$this->validate($_POST, ["IdProduit", "Quantite"]) || (intval($_POST["Quantite"]) < 1 || intval($_POST["Quantite"]) > 100)) {
            echo "Paramètres incorrects";
            return;
        }
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        $_SESSION["panier"][$_POST["IdProduit"]] = $_POST["Quantite"];
        header("Location: /produits/" . $_POST['IdProduit']);
        exit();
    }

    public function supprimerProduitPanier()
    {
        if (!$this->validate($_POST, [ "Quantite"])){
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

    public function getPanier()
    {
        return $_SESSION["panier"];
    }

    public function viderPanier()
    {
        unset($_SESSION["panier"]);
        header("Location: /panier");
        exit();
    }

    function validerPanier(array $args, bool $redirect = true)
    {
        if (Sessioncontroller::Start() === "adh") {
            header("Location: /");
            exit();
        }
        $prop = new  ProduitProducteurModel();
        try {
            foreach (PanierController::getPanier() as $id => $q) {
                if ($prop->getProduitProducteur($id) < $q) {
                    header("Location: ./panier?err=" . htmlspecialchars("Un produit n'est plus disponible."));
                    exit();
                }
            }
        } catch (\Exception $e) {
            // Gérer l'exception ici
        }

        if ($redirect) {
            header("Location: /panier/prepaiement");
            exit();
        }
    }

    public function afficherPrepaiementPanier()
    {
        PanierController::validerPanier([], false);
        
        $produits = [];
        $prod = new ProduitModel();
        foreach (PanierController::getPanier() as $id => $q) {
            $produits[] = $prod->getOneProduitInfos($id);
        }
        ViewController::init("Pre-paiement");
        ViewController::set("produits", $produits);
        ViewController::display("PanierPrepaiement");
    }
}

