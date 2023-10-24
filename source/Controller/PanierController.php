<?php
namespace Controller;

use Model\PanierModel;

class PanierController extends HomeController
{
    public function ajouterAuPanier($idProduit, $quantite)
    {
        // Assurez-vous que les valeurs sont des entiers
        if (!is_int($idProduit) || !is_int($quantite)) {
            // Gérer l'erreur ou renvoyer un message d'erreur approprié
            return "Erreur : les valeurs doivent être des entiers.";
        }

        // Utilisation de la fonction sécurisée du modèle pour ajouter au panier
        $this->ajouterAuPanier->ajouterAuPanier($idProduit, $quantite);

        // Ajouter ici la logique de redirection ou de réponse appropriée après l'ajout au panier
        header('Location: ./PanieView');
        exit();
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
        header('Location: ./PanieView');
        exit();
    }
}
