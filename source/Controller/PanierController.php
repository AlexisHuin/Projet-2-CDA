<?php

namespace Controller;

use Controller\ViewController;

use Model\AdherentModel;
use Model\PanierModel;
use Model\CommandesModel;
use Model\FactureModel;
use Model\ProducteurModel;
use Model\ProduitProducteurModel;

class PanierController extends MainController
{
    public function Panier()
    {
        $this->connectCheck("user", "Adherent", "User/");

        $total = 0;
        foreach ($_SESSION['panier'] as $panier) {
            $total += $panier['Prix'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteAll'])) {
            $panier = new PanierModel();
            $panier->IdAdherentsPanier = $_SESSION['user']['IdRole'];
            $panier->Delete();

            // $_SESSION['panier'] = [];
            header('Refresh:0.01;' . $_SERVER['REQUEST_URI']);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'delete_') === 0) {
                    $idToDelete = substr($key, 7); // Extrait l'ID à partir de la clé

                    $panier = new PanierModel();
                    $panier->IdPanier = $idToDelete;

                    $panier->Delete();

                    header('Refresh:0.01;' . $_SERVER['REQUEST_URI']);
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Validate'])) {

            $names = ["0" => "IdLigne", "1" => "Produit", "2" => "Quantite", "3" => "Prix", "4" => "Producteur"];
            $post = ["0" => $_POST['Id'], "1" => $_POST['Produit'], "2" => $_POST['Quantite'], "3" => $_POST['Prix'], "4" => $_POST['IdProd']];
            $produits = [];
            $quantites = [];

            if (intval($_POST['Total']) !== $total) {
                ExceptionHandler::SetUserError("C'est marrant d'utiliser l'inspecteur pour essayer de payer moins cher petit pd ?");
            }

            for ($j = 0; $j < count($_SESSION['panier']); $j++) {
                for ($i = 0; $i < (count($names)); $i++) {
                    if (intval($_SESSION['panier'][$j][$names[$i]]) !== intval($post[$i][$j])) {
                        ExceptionHandler::SetUserError("C'est marrant d'utiliser l'inspecteur pd ?");
                        break;
                    } else {
                        $produitproducteur = new ProduitProducteurModel();
                        if ($names[$i] === "Produit") {
                            $produits[] = $_SESSION['panier'][$j][$names[$i]];
                        } else if ($names[$i] === "Quantite") {
                            $quantites[] = $_SESSION['panier'][$j][$names[$i]];
                        }
                    }
                }
            }

            if (count(ExceptionHandler::GetUserError()) == 0) {
                $panier = new PanierModel();
                $commande = new CommandesModel();
                $facture = new FactureModel();
                $adherent = new AdherentModel();

                // Traitements table Panier
                $panier->IdAdherentsPanier = $_SESSION['user']['IdRole'];
                $panier->Delete();

                // Traitements table Commandes
                $commande->TotalCommande = $total;
                $commande->ProduitsCommande = implode(",", $produits);
                $commande->QuantitesCommande = implode(",", $quantites);
                $commande->ProducteursCommande = implode(",", $_POST['IdProd']);
                $commande->IdAdherentCommande = $_SESSION['user']['IdRole'];
                $commande->Save();

                // Traitements table Facture
                $adherent->IdAdherent = $_SESSION['user']['IdRole'];
                $adherent->Find();
                $facture->MontantFacture = $total;

                $facture->Where([$_SESSION['user']['IdRole'],"NULL"], ['idAdherent','datePrelevement']);
                $facture->Update();

                // Traitement table Adherent
                $adherent->DepenseAdherent = $total;
                $adherent->Where($_SESSION['user']['IdRole']);

                $adherent->Update();

                header('Refresh:3;/Panier');
                echo "Votre commande a bien été validée !"; 

            } else {
                header('Refresh:1;/Panier');
            }
        }

        ViewController::Set('errors', ExceptionHandler::GetUserError());
        ViewController::Set('title', 'Panier');
        ViewController::Set('total', $total);
        ViewController::Set("panier", $_SESSION['panier']);
        ViewController::Display("PanierView");
    }

    // public function ajouterProduitPanier()
    // {
    //     if (!$this->validate($_POST, ["IdProduit", "Quantite"]) || (intval($_POST["Quantite"]) < 1 || intval($_POST["Quantite"]) > 100)) {
    //         echo "Paramètres incorrects";
    //         return;
    //     }
    //     if (!isset($_SESSION["panier"])) {
    //         $_SESSION["panier"] = [];
    //     }
    //     $_SESSION["panier"][$_POST["IdProduit"]] = $_POST["Quantite"];
    //     header("Location: /produits/" . $_POST['IdProduit']);
    //     exit();
    // }

    // public function supprimerProduitPanier()
    // {
    //     if (!$this->validate($_POST, ["Quantite"])) {
    //         echo "Paramètres incorrects";
    //         return;
    //     }
    //     if (!isset($_SESSION["panier"])) {
    //         $_SESSION["panier"] = [];
    //     }
    //     unset($_SESSION["panier"][$_POST["IdProduit"]]);
    //     header("Location: /panier");
    //     exit();
    // }

    // public function getPanier()
    // {
    //     return $_SESSION["panier"];
    // }

    // public function viderPanier()
    // {
    //     unset($_SESSION["panier"]);
    //     header("Location: /panier");
    //     exit();
    // }

    // function validerPanier(array $args, bool $redirect = true)
    // {
    //     if (Sessioncontroller::Start() === "adh") {
    //         header("Location: /");
    //         exit();
    //     }
    //     $prop = new  ProduitProducteurModel();
    //     try {
    //         foreach (PanierController::getPanier() as $id => $q) {
    //             if ($prop->getProduitProducteur($id) < $q) {
    //                 header("Location: ./panier?err=" . htmlspecialchars("Un produit n'est plus disponible."));
    //                 exit();
    //             }
    //         }
    //     } catch (\Exception $e) {
    //         // Gérer l'exception ici
    //     }

    //     if ($redirect) {
    //         header("Location: /panier/prepaiement");
    //         exit();
    //     }
    // }

    // public function afficherPrepaiementPanier()
    // {
    //     PanierController::validerPanier([], false);

    //     $produits = [];
    //     $prod = new ProduitModel();
    //     foreach (PanierController::getPanier() as $id => $q) {
    //         $produits[] = $prod->getOneProduitInfos($id);
    //     }
    //     ("Pre-paiement");
    //     ViewController::set("produits", $produits);
    //     ViewController::display("PanierPrepaiement");
    // }
}
