<?php
namespace Controller;

use Controller\HomeController;
use Model\ProduitModel;
use Model\PanierModel;
use Controller\ExceptionHandler;
use Controller\ViewController;


class PanierController extends HomeController
 
{ 
    public function DisplayPanier($params)
    {
        
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
        }
        ViewController::Init("smarty");
        $panier = self::getPanier();
        $produits = [];
        $prd = new ProduitModel();
        foreach ($panier as $id => $Quantitearr) {
            $produits[$id] = $prd->getAllProduitsInfos();
            $produits[$id]["Quantite"] = $Quantitearr;
        }
        ViewController::set("produits", $produits);
        ViewController::set("panier", $panier);
        if (isset($_GET["err"])) {
            ViewController::set("err", $_GET["err"]);
        }
        
        ViewController::display("PanierView");
        
    }

    public function ajoutProduitPanier()
    {
        unset($_SESSION["panier"]);
        if (!$this->validate_array_format(["IdProduit", "Quantite"], $_POST) &&  
        (intval($_POST["Quantite"]) > 10 && intval($_POST["Quantite"]) < 1)) 

        {
            echo "Paramètres incorrects";
            return;
        }
    
        if (!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = [];
            
        }
        
        
         array_push($_SESSION['panier'], [
          "IdProduit" => $_POST["IdProduit"],
          "Quantite" => $_POST["Quantite"],
          
         ]);

        $panier = new PanierModel();
    
        // Calcul du prix total de la ligne de panier
        $PrixTotalLignePanier = $_POST['Quantite'];
        var_dump($PrixTotalLignePanier);
    
        // Définition des propriétés de l'objet PanierModel
        $panier->IdProduitProducteurPanier = $_POST['IdProduit'];
        $panier->QuantitePanier = $_POST['Quantite'];
        $panier->PrixPanier = $PrixTotalLignePanier;
        var_dump($_SESSION["panier"]);
        
    
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
        header("Location: panier");
        exit();
    }

    static public function getPanier()
    {
        return $_SESSION["panier"];
    }

    static public function viderPanier()
    {
        unset($_SESSION["panier"]);
        header("Location:PanierView");
        exit();
    }

    public function validerPanier(array $args, bool $redirect = true)
    {
        $this->connectCheck('user', 'IdAdherent'); // Assurez-vous que cette méthode est correcte
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
        ViewController::display("PanierView");
    }
}
