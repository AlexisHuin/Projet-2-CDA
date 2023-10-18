<?php

namespace Controller;

use Model\UserModel;
use Model\AdherentModel;
use Model\ProducteurModel;

use Controller\ViewController;
use Controller\SessionController;
use Controller\ExceptionHandler;
use DateTime;

// Classe UserController héritant de MainController
class UserController extends MainController
{
    public function ConnexionInscription()
    {
        // Vérifier si l'utilisateur est déjà connecté, le rediriger vers le profil
        $User = new UserModel();
        $Adherent = new AdherentModel();
        $Producteur = new ProducteurModel();

        // Gestion de l'inscription
        if (isset($_POST["Inscription"])) {
            // Vérifier si les champs du formulaire sont présents et non vides
            if (
                isset($_POST['Nom'], $_POST['Prenom'], $_POST['Pass'], $_POST['ConfirmPass'], $_POST['Email'], $_POST['RoleUser'], $_POST['GPS'], $_POST['CodePostal'], $_POST['Tel'])
                && !empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['Pass']) && !empty($_POST['ConfirmPass']) && !empty($_POST['Email'])
                && !empty($_POST['RoleUser']) && !empty($_POST['GPS']) && !empty($_POST['CodePostal']) && !empty($_POST['Tel'])
            ) {
                // Valider le nom avec le regex
                if (!preg_match("/^\pL+([a-zA-Z- ']\pL+)*$/u", $_POST["Nom"])) {
                    ExceptionHandler::SetUserError("Veuillez insérer un nom");
                }

                // Valider le prénom avec le regex
                if (!preg_match("/^\pL+([a-zA-Z- ']\pL+)*$/u", $_POST["Prenom"])) {
                    ExceptionHandler::SetUserError("Veuillez insérer un prénom");
                }

                // Valider l'adresse email
                if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
                    ExceptionHandler::SetUserError("Veuillez insérer un email conforme ");
                }

                // Valider la longueur du numéro de téléphone
                if (strlen($_POST['Tel']) > 13) {
                    ExceptionHandler::SetUserError("Veuillez insérer un numéro valide");
                }

                // Valider que les mots de passe correspondent
                if ($_POST['Pass'] !== ($_POST['ConfirmPass'])) {
                    ExceptionHandler::SetUserError("Mot de passe ne correspond pas");
                }

                $errors = ExceptionHandler::GetUserError();

                // S'il n'y a pas d'erreurs, enregistrer l'utilisateur
                if (count($errors) == 0) {
                    $User->UsernameUser = htmlspecialchars(($_POST['Nom'] . "." . $_POST['Prenom']));
                    $User->EmailUser = htmlspecialchars($_POST['Email']);
                    $User->MdpUser = password_hash($_POST['Pass'], PASSWORD_ARGON2ID);
                    $User->RoleUser = $_POST['RoleUser'];
                    $IdUser = $User->Save();

                    switch ($User->RoleUser) {
                        case "Adherent":

                            $Adherent->NomPrenomAdherents = htmlspecialchars($_POST['Nom'] . " " . ($_POST['Prenom']));
                            $Adherent->PhoneAdherents = htmlspecialchars($_POST['Tel']);
                            $Adherent->CoordonneesGPSAdherents = htmlspecialchars($_POST['GPS']);
                            $Adherent->CodePostalAdherents = htmlspecialchars($_POST['CodePostal']);
                            // explique le (new dateTime())
                            $Adherent->DateDebutAdherents = (new DateTime())->format('Y-m-d');
                            $Adherent->MailAdherents = htmlspecialchars($_POST['Email']);
                            $IdAdherent = $Adherent->Save();
                            break;

                        case "Producteur":
                            $Producteur->NomPrenomProducteur = htmlspecialchars($_POST['Nom'] . ($_POST['Prenom']));
                            $Producteur->PhoneProducteur = htmlspecialchars($_POST['Tel']);
                            $Producteur->CoordonneesGPSProducteur = htmlspecialchars($_POST['GPS']);
                            $Producteur->CodePostalProducteur = htmlspecialchars($_POST['CodePostal']);
                            $Producteur->MailProducteur = htmlspecialchars($_POST['Email']);

                            $IdProducteur = $Producteur->Save();
                            break;
                    }

                    $UserArr = [
                        'Id' => $IdUser,
                        'Email' => $User->EmailUser,
                        'RoleUser' => $User->RoleUser,
                        'Username' => $User->UsernameUser
                    ];

                    SessionController::Set("user", $UserArr);
                    SessionController::Save();
                    header('location: /User/Profile ');
                    exit;
                }
            } else {
                ExceptionHandler::SetUserError("Remplir tout les champs");
                $errors = ExceptionHandler::GetUserError();
            }
            var_dump($errors);
        }

        // Gestion de la connexion
        if (isset($_POST["Connexion"])) {
            if (isset($_POST['Pass'], $_POST['Email']) && !empty($_POST['Pass']) && !empty($_POST['Email'])) {
                if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
                    ExceptionHandler::SetUserError("Adresse Email ou Mot de passe incorrecte");
                }
                $errors = ExceptionHandler::GetUserError();
                if (count($errors) == 0) {
                    $User->EmailUser = $_POST['Email'];
                }
            }

            // Rechercher l'utilisateur dans la base de données
            $Log = $User->FindOne();
            if ($Log) {
                if (password_verify($_POST['Pass'], $Log['MdpUser'])) {
                    $UserArr = [
                        'Id' => $Log['IdUser'],
                        'Email' => $User->EmailUser,
                        'RoleUser' => $Log['RoleUser'],
                        'Username' => $Log['UsernameUser']
                    ];
                    SessionController::Set("user", $UserArr);
                    SessionController::Save();
                    header('location:/User/Profile ');
                    exit;
                }
            }
        }

        // Initialisation de la vue (Smarty)
        ViewController::Init('smarty');

        // Gestion des erreurs
        if (empty($errors)) {
            ViewController::Set('Error', '');
        } else {
            ViewController::Set('Error', $errors);
        }

        ViewController::Set('title', 'Login');
        ViewController::Display('LoginView');
    }
    public function Profile()
    {
        switch ($_SESSION['user']['RoleUser']) {
            case "Adherent":
                $NewUser = new AdherentModel();
                $NewUser->MailAdherents = $_SESSION['user']['Email'];
                break;
            case "Producteur":
                $NewUser = new ProducteurModel();
                $NewUser->MailProducteur = $_SESSION['user']['Email'];
                break;
        }
        $Infos = $NewUser->FindOne();
        
        ViewController::Init('smarty');
        ViewController::Set('title', 'Profile');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('Infos', $Infos);
        ViewController::Display('ProfileView');
    }
    // Déconnection de l'utilisateur
    public function Deconnexion()
    {
        session_destroy();
        // A la déconnection renvoyer a la page d'acceuil
        header('location: /User');
        exit;
    }
}
