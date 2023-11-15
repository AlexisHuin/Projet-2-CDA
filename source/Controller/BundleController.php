<?php

namespace Controller;

use Model\ProduitProducteurModel;
use Model\BundleModel;
use Model\DemandesModel;

class BundleController extends MainController
{

    // fonction pour afficher la page Contact

    public function Bundle(): void
    {

        $Produits = new ProduitProducteurModel();
        $AllProduits = $Produits->getProduitProducteur($_SESSION['user']['IdRole'], true, true);
        ViewController::Set('title', 'Gérer mes bundles');
        ViewController::Set('AllProduits', $AllProduits);


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBundle'])) {

            $datas = $this->validate($_POST, [
                'DesignationBundle', 'PrixBundle', 'QuantiteProduitsBundle', 'IdProduitProducteur'
            ]);


            $this->AddNewBundle($datas);
        }

        ViewController::Display('BundleView');
    }

    public function AddNewBundle($datas): void
    {
        $quantites = [];
        $IdProducteur = $_SESSION['user']['IdRole'];
        $bundle = new BundleModel();



        $bundle->DesignationBundle = htmlentities($datas['DesignationBundle'], ENT_QUOTES);
        $bundle->IdProducteurBundle = $IdProducteur;

        //j'initialise mon total a 0, et pour chaque prix, je le multiplie par la quantitée

        $total = 0;
        for ($i = 0; isset($datas['PrixBundle']) && $i < count($datas['PrixBundle']); $i++) {
            $total += $datas['PrixBundle'][$i] * $datas['QuantiteProduitsBundle'][$i];
        }



        // Parcours de chaque élément dans le tableau associatif $_POST['IdProduitProducteur']
        foreach ($_POST['IdProduitProducteur'] as $cardKey => $idProduit) {

            // Création d'une nouvelle instance de la classe ProduitProducteurModel
            $produitProducteur = new ProduitProducteurModel();

            // Attribution de la valeur de l'ID du produit producteur à l'instance
            $produitProducteur->IdProduitProducteur = $idProduit;

            // Recherche de la quantité actuelle du produit producteur dans la base de données
            $qt = $produitProducteur->Find('QuantiteProduitProducteur', 'Fetch');

          

            // Soustraction de la quantité postée ($_POST['QuantiteProduitsBundle'][$cardKey])
            // à la quantité actuelle du produit producteur
            $produitProducteur->QuantiteProduitProducteur = $qt['QuantiteProduitProducteur'] - $_POST['QuantiteProduitsBundle'][$cardKey];

            // Spécification de la condition de mise à jour
            $produitProducteur->Where($idProduit);

            // Mise à jour de l'enregistrement dans la base de données
            $produitProducteur->Update();

            // Libération de la mémoire en supprimant l'instance
            unset($produitProducteur);
        }


        // je prend mon total, et je soustrait le pourcentage calculé de mon total
        $PrixReduction = $total - (($total / 100) * 20);
        $bundle->PrixBundle = $PrixReduction;
        $bundle->QuantiteProduitsBundle = $this->concatenationPower($datas, 'QuantiteProduitsBundle');

        $bundle->IdProduitsBundle = $this->concatenationPower($datas, 'IdProduitProducteur');




        $IdBundle = $bundle->Save();


    // ! A REVOIR TABLE DEMANDE
        $Demandes = new DemandesModel();
        $Demandes->IdUserDemande = $_SESSION['user']['Id'];
        $Demandes->IdProduitProducteurDemande = $IdBundle;
        $Demandes->ObjetDemande = 'Bundle';
        $Demandes->PrixProposeDemande = $PrixReduction;
        $Demandes->DesignationProduitDemande = htmlentities($datas['DesignationBundle'], ENT_QUOTES);
        $Demandes->MotifDemande = "Le producteur " . $_SESSION['user']['Username'] . " souhaite ajouter le bundle " . htmlentities($datas['DesignationBundle'], ENT_QUOTES) .
            " au prix de " . $PrixReduction;
        $Demandes->Save();


        header('Refresh:3;/Bundle');
        echo "Votre bundle a bien été validée !";
    }

    private function concatenationPower(array $datas, string $fieldName): string
    {
        // Filtrer les éléments vides
        $filteredArray = array_filter($datas[$fieldName]);

        // Concaténer les valeurs filtrées
        $result = implode(',', $filteredArray);

        return $result;
    }
}
