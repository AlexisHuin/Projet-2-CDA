<?php
namespace Model;

// Suppose que vous avez déjà configuré la connexion à la base de données

class PanierModel
{
    // Ajouter un produit au panier
    public function ajouterAuPanier($idProduit, $IdAdherents, )
    {
        // Votre code pour ajouter le produit au panier
        // Assurez-vous de gérer les erreurs potentielles et les vérifications de sécurité ici
        // Exemple d'opération de base de données pour ajouter au panier
        $sql = "INSERT INTO Panier (IdProduit, IdUtilisateur, Quantite) 
                VALUES ('$idProduit', '$IdAdherents')";
        // Exécutez votre requête SQL ici
        exec($sql);
    }

    // Récupérer les éléments du panier pour un utilisateur spécifique
    public function getPanierUtilisateur($IdAdherents)
    {
        
        // Exemple de requête pour récupérer le panier de l'utilisateur depuis la base de données
        $sql = "SELECT * FROM Panier WHERE IdAdherents = '$IdAdherents'";
        exec($sql);
        // Retournez les résultats
    }

    // Supprimer un produit du panier pour un utilisateur spécifié
    public function supprimerDuPanier($IdProduit, $IdAdherents)
    {
        // Votre code pour supprimer un produit du panier pour l'utilisateur spécifié
        // Exemple de requête pour supprimer du panier dans la base de données
        $sql = "DELETE FROM Panier WHERE IdProduit = '$IdProduit' AND IdUtilisateur = '$IdAdherents'";
        exec($sql);
        // Exécutez votre requête SQL ici
    }
}
