<?php
namespace Controller;

use Model\PanierModel;

class PanierController
{
    private $panierModel;

    public function __construct($db)
    {
        $this->panierModel = new PanierModel($db);
    }

    public function ajouterAuPanier($idProduit, $IdAdherents, $quantite)
    {
        // Assurez-vous que les valeurs sont des entiers
        if (!is_int($idProduit) || !is_int($IdAdherents) || !is_int($quantite)) {
            // Gérer l'erreur ou renvoyer un message d'erreur approprié
            return "Erreur : les valeurs doivent être des entiers.";
        }

        // Utilisation de la fonction sécurisée du modèle pour ajouter au panier
        $this->panierModel->ajouterAuPanier($idProduit, $IdAdherents, $quantite);

        // Ajouter ici la logique de redirection ou de réponse appropriée après l'ajout au panier
        header('Location: /panier');
        exit();
    }

    public function getPanierAdherents($IdAdherents)
    {
        // Assurez-vous que la valeur est un entier
        if (!is_int($IdAdherents)) {
            // Gérer l'erreur ou renvoyer un message d'erreur approprié
            return "Erreur : la valeur doit être un entier.";
        }

        // Utilisation de la fonction du modèle pour récupérer le panier
        $panier = $this->panierModel->GetPanierAdherents($IdAdherents);

        // Ajouter ici la logique pour afficher le panier ou renvoyer les données au format approprié
        return $panier;
    }

    public function supprimerDuPanier($IdProduit, $IdAdherents)
    {
        // Assurez-vous que les valeurs sont des entiers
        if (!is_int($IdProduit) || !is_int($IdAdherents)) {
            // Gérer l'erreur ou renvoyer un message d'erreur approprié
            return "Erreur : les valeurs doivent être des entiers.";
        }

        // Utilisation de la fonction sécurisée du modèle pour supprimer du panier
        $this->panierModel->supprimerDuPanier($IdProduit, $IdAdherents);

        // Ajouter ici la logique de redirection ou de réponse appropriée après la suppression du panier
        header('Location: /panier');
        exit();
    }
}
