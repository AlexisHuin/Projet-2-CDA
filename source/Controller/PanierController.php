<?php
namespace Controller;

use Model\PanierModel;


class PanierController
{
  
    
    public function AddPanier($_params=[])
    { 
        $IdProduit = $_POST['$IdProduit'];
        $IdAdherents = $_POST['IdAdherents'];
        $Quantité = $_POST('$Quantité');

        $panier = new PanierModel();

        $panier->ajouterAuPanier($IdProduit,$IdAdherents,$Quantité );  
        header('Location:/DescriptifProduit/');
        exit();
    }

    public function ListPanier($_params=[])
    {
        ViewController::Init('smarty');
        
    }
    public function DeletePanier($_params=[])
    {
       
        
    }
}
?>