<?php

namespace Model;

use Model\DbModel;

class NotificationsModel extends DbModel
{
    protected $table = 'Notifications';
    protected string $id = 'IdNotification';

    public function getNotifications(): string|object|array
    {
        return DbModel::Select("");
    }

    // public function ModifPrixDemande(): string|object|array
    // {
    //     return DbModel::Select(
    //         "SELECT IdDemande, ObjetDemande, MotifDemande, IdUserDemande, IdProduitProducteurDemande, EtatDemande, NomPrenomProducteur 
    //     FROM Demandes
    //     JOIN Producteur ON Demandes.IdUserDemande = Producteur.IdProducteur;"
    //     );
    // }
}
