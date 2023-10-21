<?php

namespace Controller;

use Model\UserModel;
use Model\AdherentModel;
use Model\ProducteurModel;
use Model\ProduitModel;

use Controller\ViewController;
use Controller\SessionController;
use Controller\ExceptionHandler;
use DateTime;

// Classe UserController héritant de MainController
class UserController extends MainController
{
    public function ConnexionInscription(): void
    {
        // Vérifier si l'utilisateur est déjà connecté, le rediriger vers le profil
        if (isset($_SESSION['user'])) {
            header('Location: /User/Profile');
            exit();
        }
        $User = new UserModel();
        $Adherent = new AdherentModel();
        $Producteur = new ProducteurModel();

        // Gestion de l'inscription
        if (isset($_POST["Inscription"])) {

            $datas = $this->validate($_POST, ['Nom', 'Prenom', 'Pass', 'ConfirmPass', 'Tel', 'Email', 'CodePostal', 'GPS', 'RoleUser']);
            // Vérifier si les champs du formulaire sont présents et non vides
            if ($datas) {
                // Valider le nom avec le regex
                if (!preg_match("/^\pL+([a-zA-Z- ']\pL+)*$/u", $datas["Nom"])) {
                    ExceptionHandler::SetUserError("Veuillez insérer un nom");
                }

                // Valider le prénom avec le regex
                if (!preg_match("/^\pL+([a-zA-Z- ']\pL+)*$/u", $datas["Prenom"])) {
                    ExceptionHandler::SetUserError("Veuillez insérer un prénom");
                }

                // Valider l'adresse email
                if (!filter_var($datas["Email"], FILTER_VALIDATE_EMAIL)) {
                    ExceptionHandler::SetUserError("Veuillez insérer un email conforme ");
                }

                // Valider la longueur du numéro de téléphone
                if (strlen($datas['Tel']) > 13) {
                    ExceptionHandler::SetUserError("Veuillez insérer un numéro valide");
                }

                // Valider que les mots de passe correspondent
                if ($datas['Pass'] !== ($datas['ConfirmPass'])) {
                    ExceptionHandler::SetUserError("Mot de passe ne correspond pas");
                }

                $errors = ExceptionHandler::GetUserError();

                // S'il n'y a pas d'erreurs, enregistrer l'utilisateur
                if (count($errors) == 0) {
                    $User->UsernameUser = ($datas['Nom'] . "." . $datas['Prenom']);
                    $User->EmailUser = $datas['Email'];
                    $User->MdpUser = password_hash($datas['Pass'], PASSWORD_ARGON2ID);
                    $User->RoleUser = $datas['RoleUser'];
                    $IdUser = $User->Save();

                    switch ($User->RoleUser) {
                        case "Adherent":

                            $Adherent->NomPrenomAdherents = htmlspecialchars($datas['Nom'] . " " . ($datas['Prenom']));
                            $Adherent->PhoneAdherents = htmlspecialchars($datas['Tel']);
                            $Adherent->CoordonneesGPSAdherents = htmlspecialchars($datas['GPS']);
                            $Adherent->CodePostalAdherents = htmlspecialchars($datas['CodePostal']);
                            // explique le (new dateTime())
                            $Adherent->DateDebutAdherents = (new DateTime())->format('Y-m-d');
                            $Adherent->MailAdherents = htmlspecialchars($datas['Email']);
                            $IdAdherent = $Adherent->Save();
                            break;

                        case "Producteur":
                            $Producteur->NomPrenomProducteur = htmlspecialchars($datas['Nom'] . ($datas['Prenom']));
                            $Producteur->PhoneProducteur = htmlspecialchars($datas['Tel']);
                            $Producteur->CoordonneesGPSProducteur = htmlspecialchars($datas['GPS']);
                            $Producteur->CodePostalProducteur = htmlspecialchars($datas['CodePostal']);
                            $Producteur->MailProducteur = htmlspecialchars($datas['Email']);

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

            $datas = $this->validate($_POST, ['Email', 'Pass']);

            if ($datas) {
                if (!filter_var($datas["Email"], FILTER_VALIDATE_EMAIL)) {
                    ExceptionHandler::SetUserError("Veuillez entrer une adresse e-mail valide.");
                }
                $errors = ExceptionHandler::GetUserError();
                if (count($errors) == 0) {
                    $User->EmailUser = $datas['Email'];
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
                } else {
                    ExceptionHandler::SetUserError("Informations incorrectes.");
                    $errors = ExceptionHandler::GetUserError();
                }
            }
            var_dump($errors);
        }

        // Initialisation de la vue (Smarty)
        ViewController::Init('smarty');
        ViewController::Set('title', 'Login');
        ViewController::Display('LoginView');
    }
    public function Profile(): void
    {
        $this->connectCheck('user', '/User/');

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
    public function Deconnexion(): void
    {
        session_destroy();
        // A la déconnection renvoyer a la page d'acceuil
        header('Location: /');
        exit;
    }
    public function AddProduct() {

        // définir que le code s'affiche que si je suis producteur avec un if
        // sinon je renvoi a l'accueil
        $ProduitProducteur = new ProduitModel();
        
        
        ViewController::Init('smarty');
        ViewController::Set('title', 'Ajouter un produit');
        ViewController::Set('products',$ProduitProducteur->getProduits());
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Display('AddProductView');
    }
}
