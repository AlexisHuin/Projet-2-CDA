<?php
namespace Controller;

use Controller\HomeController;
use Model\ProduitModel;
use Model\PanierModel;
use Controller\ExceptionHandler;
use Controller\ViewController;

class PanierController extends HomeController
 
{ 
    public function DisplayPanier(array $params)
    {
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        ViewController::init("Panier");
        $panier = self::getPanier();
        $produits = [];
        $prd = new ProduitModel();
        foreach ($panier as $id => $quantitearr) {
            $produits[$id] = $prd->getAllProduitsInfos();
            $produits[$id]["Quantite"] = $quantitearr;
        }
        ViewController::set("produits", $produits);
        if (isset($_GET["err"])) {
            ViewController::set("err", $_GET["err"]);
        }
        ViewController::display("PanierView");
        
    }

    public function ajoutProduitPanier()
    {
        if (!$this->validate_array_format(["IdProduit", "quantite"], $_POST) || (intval($_POST["quantite"]) > 10 || intval($_POST["quantite"]) < 1)) {
            echo "Paramètres incorrects";
            return;
        }
    
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
    
        array_push($_SESSION['panier'], [
            "IdProduitProducteur" => $_POST["IdProduitProducteur"],
            "Quantite" => $_POST["quantite"],
            "Prix" => $_POST['Prix'],
            "IdAdherent" => $_SESSION['user']['IdRole']
        ]);
    

        $panier = new PanierModel();
    
        // Calcul du prix total de la ligne de panier
        $prixTotalLignePanier = $_POST['quantite'] * $_POST['Prix'];
    
        // Définition des propriétés de l'objet PanierModel
        $panier->IdProduitProducteurPanier = $_POST['IdProduitProducteur'];
        $panier->QuantitePanier = $_POST['quantite'];
        $panier->PrixPanier = $prixTotalLignePanier;
        $panier->IdAdherentsPanier = $_SESSION['user']['IdRole'];
    
        exit(); // Assurez-vous que cela est utilisé dans le contexte approprié de votre application
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
                $prop = new PanierModel(); // À vérifier si c'est bien nécessaire
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
            $produits[] = $prod->getProduits();
        }
        ViewController::set("produits", $produits);
        ViewController::display("PanierPrepaiement");
    }
}
