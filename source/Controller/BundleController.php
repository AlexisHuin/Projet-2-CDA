<?php

namespace Controller;

use Model\ProduitProducteurModel;
use Model\BundleModel;

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

            $this->AddNewBundle($_POST);
        }
        
        ViewController::Display('BundleView');
    }

    public function AddNewBundle(array $datas): void
    {


        $bundle = new BundleModel();

        $bundle->DesignationBundle = htmlentities($datas['DesignationBundle'], ENT_QUOTES);
        $bundle->IdProducteurBundle = $_SESSION['user']['IdRole'];


        $bundle->PrixBundle = $this->concatenationPower($datas, 'PrixBundle');
        $bundle->QuantiteProduitsBundle = $this->concatenationPower($datas, 'QuantiteProduitsBundle');
        $bundle->IdProduitsBundle = $this->concatenationPower($datas, 'IdProduitProducteur');



        $bundle->Save();


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