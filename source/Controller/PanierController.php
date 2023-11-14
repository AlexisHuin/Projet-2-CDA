<?php

namespace Controller;

use Controller\ViewController;

use Model\AdherentModel;
use Model\PanierModel;
use Model\CommandesModel;
use Model\FactureModel;
use Model\NotificationsModel;
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
            $this->deletePanier();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->deleteOnePanier();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Validate'])) {

            $names = ["0" => "IdLigne", "1" => "Produit", "2" => "Quantite", "3" => "Prix", "4" => "Producteur"];
            $post = ["0" => $_POST['Id'], "1" => $_POST['Produit'], "2" => $_POST['Quantite'], "3" => $_POST['Prix'], "4" => $_POST['IdProd']];
            $produits = [];
            $quantites = [];

            if (floatval($_POST['Total']) !== $total) {
                ExceptionHandler::SetUserError("C'est marrant d'utiliser l'inspecteur pour essayer de payer moins cher petit pd ?");
            }

            for ($j = 0; $j < count($_SESSION['panier']); $j++) {
                for ($i = 0; $i < (count($names)); $i++) {
                    if (floatval($_SESSION['panier'][$j][$names[$i]]) !== floatval($post[$i][$j])) {
                        ExceptionHandler::SetUserError("C'est marrant d'utiliser l'inspecteur pd ?");
                        break;
                    } else {
                        if ($names[$i] === "Produit") {
                            $produits[] = $_SESSION['panier'][$j][$names[$i]];
                        } else if ($names[$i] === "Quantite") {
                            $quantites[] = $_SESSION['panier'][$j][$names[$i]];
                        }
                    }
                }
            }

            if (count(ExceptionHandler::GetUserError()) == 0) {
                $commande = new CommandesModel();
                $facture = new FactureModel();
                $adherent = new AdherentModel();
                $produitProducteur = new ProduitProducteurModel();
                $notifications = new NotificationsModel();

                // Traitements table Panier
                $this->deletePanier();

                // Traitements table Commandes
                $commande->TotalCommande = $total;
                $commande->ProduitsCommande = implode(",", $produits);
                $commande->QuantitesCommande = implode(",", $quantites);
                $commande->ProducteursCommande = implode(",", $_POST['IdProd']);
                $commande->IdAdherentCommande = $_SESSION['user']['IdRole'];
                $commande->Save();

                // Traitements table Facture
                $adherent->IdAdherent = $_SESSION['user']['IdRole'];
                $totalActuel = $adherent->Find('DepenseAdherent', 'Fetch');

                $facture->MontantFacture = $totalActuel['DepenseAdherent'] + $total;

                $facture->Where([$_SESSION['user']['IdRole'], "'En cours'"], ['idAdherent', 'datePrelevement']);
                $facture->Update();

                // Traitement table Adherent
                $adherent->DepenseAdherent = $totalActuel['DepenseAdherent'] + $total;

                $adherent->Where($_SESSION['user']['IdRole']);
                $adherent->Update();

                foreach ($_POST['Produit'] as $key => $idProduit) {
                    $produitProducteur->IdProduitProducteur = $idProduit;
                    $qt = $produitProducteur->Find('QuantiteProduitProducteur', 'Fetch');

                    $produitProducteur->QuantiteProduitProducteur = $qt['QuantiteProduitProducteur'] - $quantites[$key];

                    $produitProducteur->Where($idProduit);
                    $produitProducteur->Update();
                }

                $notifications->IdDestinataireNotification = $_SESSION['user']['Id'];
                $notifications->DateEnvoiNotification = date('d-M-Y H:i');
                $notifications->MotifNotification = "Votre commande a bien été prise en compte, vous disposez à présent de 2 jours pour venir la récupérer, sans quoi, la commande sera annulée et vous serez tout de même débité.";
                $notifications->Save();

                header('Refresh:1;/Panier');
                echo "Commande validé avec succès !";
                exit();
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

    private function deleteOnePanier(): void
    {
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

    private function deletePanier(): void
    {
        $panier = new PanierModel();
        $panier->IdAdherentsPanier = $_SESSION['user']['IdRole'];
        $panier->Delete();

        // $_SESSION['panier'] = [];
        header('Refresh:0.01;' . $_SERVER['REQUEST_URI']);
    }
}
