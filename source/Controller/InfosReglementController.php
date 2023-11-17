<?php

namespace Controller;

use DateTime;
use Model\InfosReglementModel;

abstract class InfosReglementController
{

    // Fonction pour ajouté les coordonnées bancaire de l'adhérent, pour le formulaire sur la page Profil
    // Toutes les données sauf expiration, et titulaire sont cryptés, et les données attendu vérifié avec un compte pour les erreurs
    // La fonction permet aussi d'update si des données sont déja présente.

    public static function AddInfosReglement(array|string|object $datas): array
    {

        if (strlen($datas['NumeroCB']) !== 16) {
            ExceptionHandler::SetUserError("Veuillez insérer un numéro de CB valide");
        }
        if (!preg_match("/^\pL+([a-zA-Z- ']\pL+)*$/u", $datas["Titulaire"])) {
            ExceptionHandler::SetUserError("Veuillez insérer un nom valide");
        }

        if (strlen($datas['CVV']) !== 3) {
            ExceptionHandler::SetUserError("Veuillez insérer un numéro de CVV valide");
        }
        $errors = ExceptionHandler::GetUserError();

        return $errors;
    }

    public static function SaveInfosReglement(array|string|object $datas): void{
        $infosReglement = new InfosReglementModel();
        //* $datas[0] = IdAdherent
        $infosReglement->IdAdherentInfosReglement = $datas[0];
        $result = $infosReglement->Find('IdInfosReglement', 'Fetch');
            $infosReglement->CodeCBInfosReglement = password_hash($datas['NumeroCB'], PASSWORD_ARGON2ID);
            $infosReglement->TitulaireInfosReglement = $datas['Titulaire'];
            $infosReglement->ExpirationInfosReglement = (new DateTime($datas['DateExpiration']))->format('m-y');
            $infosReglement->CVVInfosReglement = password_hash($datas['CVV'], PASSWORD_ARGON2ID);
            if ($result) {
                $infosReglement->Where($result['IdInfosReglement']);
                $infosReglement->Update();
                header('Refresh:1;' . $_SERVER['REQUEST_URI']);
                echo 'Modifié avec succés';
            } else {
                $infosReglement->Save();
                header('Refresh:1;' . $_SERVER['REQUEST_URI']);
                echo 'Ajouté avec succés';
            }
        } 

        
    

    // Fonction pour récupéré les coordonnées bancaires si elles sont présente pour affiché sur la page profil si il dois
    // ajouter ou non un mode de paiement.

    public static function GetOneInfosReglement(): array|string|object
    {
        $oneInfosReglement = new InfosReglementModel();
        $oneInfosReglement->IdAdherentInfosReglement = $_SESSION['user']['IdRole'];
        return $oneInfosReglement->Find('*', 'Fetch');
    }
}
