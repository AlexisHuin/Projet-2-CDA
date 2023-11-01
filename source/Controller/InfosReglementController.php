<?php

namespace Controller;

use DateTime;
use Model\InfosReglementModel;
use Model\AdherentModel;

use Controller\SessionController;

 // Deplacé la clef etranger dans la table InfosReglement, pour récupération de données.
abstract class InfosReglementController
{
    public static function AddInfosReglement(array|string|object $datas): string
    {

        $infosReglement = new InfosReglementModel();
        $adherent = new AdherentModel();
        $adherent->IdAdherents = $_SESSION['user']['IdRole'];
        $result = $adherent->Find('InfosReglementAdherent', 'Fetch');
        if ($result) {
            $infosReglement->IdInfosReglement = $result['InfosReglementAdherent'];
            var_dump( $result['InfosReglementAdherent']);
            $infos = $infosReglement->Find();
            var_dump($infos);
            die;
        } else {
            $infos = false;
        }



        if (strlen($datas['NumeroCB']) !== 16) {
            ExceptionHandler::SetUserError("Veuillez insérer un numéro valide");
        }
        if (!preg_match("/^\pL+([a-zA-Z- ']\pL+)*$/u", $datas["Titulaire"])) {
            ExceptionHandler::SetUserError("Veuillez insérer un nom valide");
        }

        if (strlen($datas['CVV']) !== 3) {
            ExceptionHandler::SetUserError("Veuillez insérer un numéro valide");
        }
        $errors = ExceptionHandler::GetUserError();

        if (count($errors) == 0) {
            $infosReglement->CodeCBInfosReglement = password_hash($datas['NumeroCB'], PASSWORD_ARGON2I);
            $infosReglement->TitulaireInfosReglement = $datas['Titulaire'];
            $infosReglement->ExpirationInfosReglement = (new DateTime($datas['DateExpiration']))->format('m-y');
            $infosReglement->CVVInfosReglement = password_hash($datas['CVV'], PASSWORD_ARGON2I);
            if ($infos) {
                $infosReglement->Where($infosReglement, $infosReglement->IdInfosReglement);
                $infosReglement->Update();
            } else {
                $infosReglement->Save();
            }
            $Succes = 'Ajouter avec succés';
            return $Succes;
        } else {
            $Succes = 'Echec';
            return $Succes;
        }
    }
}
