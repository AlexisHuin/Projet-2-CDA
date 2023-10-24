<?php

namespace Model;

use Model\DbModel;

class DemandesModel extends DbModel
{
    protected $table = 'Demandes';
    protected string $id = 'IdDemande';
    protected string $state = 'EtatDemande';

    public function getDemandes(): string|object|array
    {
        return DbModel::Select(
            "SELECT IdDemande, ObjetDemande, MotifDemande, PrixProposeDemande, IdProducteurDemande, IdProduitProducteurDemande, EtatDemande, NomPrenomProducteur 
        FROM Demandes
        JOIN Producteur ON Demandes.IdProducteurDemande = Producteur.IdProducteur;"
        );
    }

    // public function ModifPrixDemande(): string|object|array
    // {
    //     return DbModel::Select(
    //         "SELECT IdDemande, ObjetDemande, MotifDemande, IdProducteurDemande, IdProduitProducteurDemande, EtatDemande, NomPrenomProducteur 
    //     FROM Demandes
    //     JOIN Producteur ON Demandes.IdProducteurDemande = Producteur.IdProducteur;"
    //     );
    // }
}
