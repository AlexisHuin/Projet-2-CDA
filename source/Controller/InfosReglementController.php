<?php

namespace Controller;

use DateTime;
use Model\InfosReglementModel;
use Model\AdherentModel;

use Controller\SessionController;

abstract class InfosReglementController
{
    public static function AddInfosReglement(array|string|object $datas): void
    {

        $infosReglement = new InfosReglementModel();
        $infosReglement->IdAdherentInfosReglement = $_SESSION['user']['IdRole'];
        $result = $infosReglement->Find('IdInfosReglement', 'Fetch');

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
        } else {
            var_dump($errors);
        }
    }
}
