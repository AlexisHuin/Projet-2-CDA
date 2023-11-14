<?php

namespace Controller;

use Model\UserModel;
use Model\AdherentModel;
use Model\ProducteurModel;


use Controller\ViewController;
use Controller\SessionController;
use Controller\ExceptionHandler;
use Controller\InfosReglementController;

use DateTime;
use Model\BundleModel;
use Model\CommandesModel;
use Model\DemandesModel;
use Model\FactureModel;
use Model\InfosReglementModel;
use Model\NotificationsModel;
use Model\PanierModel;
use Model\ProduitProducteurModel;

// Classe UserController héritant de MainController
class UserController extends MainController
{

    // fonction qui gére la partie connexion, et l'inscription pour les adherents et producteurs
    // Elle valide les différents champs avec le regex, ou avec un nombre de caractéres/chiffres attendu.
    // Une gestion des erreurs est présente, suivant si adherent ou producteur est coché dans le formulaire,
    // l'utilisateur définie son rôle, a la suite de l'inscription la session démarre.
    // Pour la partie connexion, on fais une vérification sur l'email qui est unique a chaque users du site.

    public function ConnexionInscription(): void
    {
        // Vérifier si l'utilisateur est déjà connecté, le rediriger vers le profil
        $this->connectCheck('user');

        $User = new UserModel();
        $Adherent = new AdherentModel();
        $Producteur = new ProducteurModel();

        $errors = [];
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
                            $Adherent->NomPrenomAdherent = htmlspecialchars($datas['Nom'] . " " . ($datas['Prenom']));
                            $Adherent->PhoneAdherent = htmlspecialchars($datas['Tel']);
                            $Adherent->CoordonneesGPSAdherent = htmlspecialchars($datas['GPS']);
                            $Adherent->CodePostalAdherent = htmlspecialchars($datas['CodePostal']);
                            // explique le (new dateTime())
                            $Adherent->DateDebutAdherent = (new DateTime())->format('Y-m-d');
                            $Adherent->MailAdherent = htmlspecialchars($datas['Email']);
                            $IdRole = $Adherent->Save();

                            $facture = new FactureModel();
                            $facture->MontantFacture = 15.00;
                            $facture->IdAdherentFacture = $IdRole;
                            $facture->Save();
                            break;

                        case "Producteur":
                            $Producteur->NomPrenomProducteur = htmlspecialchars($datas['Nom'] . ($datas['Prenom']));
                            $Producteur->PhoneProducteur = htmlspecialchars($datas['Tel']);
                            $Producteur->CoordonneesGPSProducteur = htmlspecialchars($datas['GPS']);
                            $Producteur->CodePostalProducteur = htmlspecialchars($datas['CodePostal']);
                            $Producteur->MailProducteur = htmlspecialchars($datas['Email']);

                            $IdRole = $Producteur->Save();
                            break;
                    }

                    $UserArr = [
                        'Id' => $IdUser,
                        'IdRole' => $IdRole,
                        'Email' => $User->EmailUser,
                        'RoleUser' => $User->RoleUser,
                        'Username' => $User->UsernameUser
                    ];

                    SessionController::Set("user", $UserArr);
                    SessionController::Save();
                    header('location: /User/Profile ');
                    exit();
                }
            } else {
                ExceptionHandler::SetUserError("Remplir tout les champs");
                $errors = ExceptionHandler::GetUserError();
            }
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
                $Log = $User->Find('*', 'Fetch');
                if ($Log) {
                    if (password_verify($_POST['Pass'], $Log['MdpUser'])) {
                        if ($Log['RoleUser'] === 'Adherent') {
                            $Adherent->MailAdherent = $datas['Email'];
                            $Result = $Adherent->Find('*', 'Fetch');
                            $UserArr = [
                                'Id' => $Log['IdUser'],
                                'IdRole' => $Result['IdAdherent'],
                                'Email' => $User->EmailUser,
                                'RoleUser' => $Log['RoleUser'],
                                'Username' => $Log['UsernameUser']
                            ];
                        } else if ($Log['RoleUser'] === 'Producteur') {
                            $Producteur->MailProducteur = $datas['Email'];
                            $Result = $Producteur->Find('*', 'Fetch');
                            $UserArr = [
                                'Id' => $Log['IdUser'],
                                'IdRole' => $Result['IdProducteur'],
                                'Email' => $User->EmailUser,
                                'RoleUser' => $Log['RoleUser'],
                                'Username' => $Log['UsernameUser']
                            ];
                        }
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
        }

        ViewController::Set('errors', $errors);
        ViewController::Set('title', 'Login');
        ViewController::Display('LoginView');
    }

    // Fonction qui gére la partie profil des adherents et producteurs, elle liste toutes les coordonnées, permet d'appeler 
    // les fonctions pour modifier ces coordonnées.
    // Pour les adherents elle appelle également la fonction pour ajouter un mode de réglement ( CB ), également la fonction pour supprimer
    // les infos de CB.

    public function Profile(): void
    {

        $this->connectCheck('user');
        $Reglement = InfosReglementController::GetOneInfosReglement();

        $errors = [];
        if (isset($_POST["Confirmation"])) {

            $datas = $this->validate($_POST, ['Titulaire', 'NumeroCB', 'DateExpiration', 'CVV']);
            if ($datas) {
                InfosReglementController::AddInfosReglement($datas);
            } else {
                ExceptionHandler::SetUserError("Veuillez remplir tout les champs");
            }
        }
        if (isset($_POST['Supprimer'])) {
            $OneInfosReglement = new InfosReglementModel();
            $OneInfosReglement->IdInfosReglement = $_POST['Id'];
            $OneInfosReglement->Delete();

            header('Refresh:1;/User/Profile');
            echo "Données bancaires supprimées";
            exit();
        }
        if (isset($_POST["modification"])) {
            if ($_SESSION['user']['RoleUser'] === "Adherent") {
                $NewUser = new AdherentModel();
                $datas = $this->validate($_POST, ['NomPrenomAdherent', 'PhoneAdherent', 'CodePostalAdherent', 'CoordonneesGPSAdherent']);
                $this->UpdateProfil($datas, $NewUser, ['NomPrenomAdherent', 'PhoneAdherent', 'CodePostalAdherent', 'CoordonneesGPSAdherent'], '/User/Profile');
            } else if ($_SESSION['user']['RoleUser'] === "Producteur") {
                $NewUser = new ProducteurModel();
                $datas = $this->validate($_POST, ['NomPrenomProducteur', 'PhoneProducteur', 'CodePostalProducteur', 'CoordonneesGPSProducteur', 'RaisonSocialeProducteur']);
                $this->UpdateProfil($datas, $NewUser, ['NomPrenomProducteur', 'PhoneProducteur', 'CodePostalProducteur', 'CoordonneesGPSProducteur', 'RaisonSocialeProducteur'], '/User/Profile');
            }
        } else {
            ExceptionHandler::SetUserError("Veuillez remplir tout les champs");
        }
        if (isset($_POST['DeleteAcc'])) {
            $User = new UserModel();
            $Notifications = new NotificationsModel();
            $Id = $_SESSION['user']['Id'];

            if ($_SESSION['user']['RoleUser'] == "Adherent") {
                $Adherent = new AdherentModel();
                $infosReglement = new InfosReglementModel();
                $Panier = new PanierModel();
                $Commandes = new CommandesModel();
                $Facture = new FactureModel();

                $infosReglement->IdAdherentInfosReglement =
                    $Panier->IdAdherentsPanier =
                    $Facture->IdAdherentFacture =
                    $Commandes->IdAdherentCommande =
                    $Adherent->IdAdherent = $_SESSION['user']['IdRole'];

                $infosReglement->Delete();
                $Panier->Delete();
                $Facture->Delete();
                $Commandes->Delete();
                $Adherent->Delete();
            } else {
                $Producteur = new ProducteurModel();
                $ProduitProducteur = new ProduitProducteurModel();
                $Bundle = new BundleModel();
                $Demandes = new DemandesModel();

                $Bundle->IdProducteurBundle = $ProduitProducteur->IdProducteurProduitProducteur = $Demandes->IdUserDemande = $Producteur->IdProducteur = $_SESSION['user']['IdRole'];

                $Demandes->Delete();
                $Bundle->Delete();
                $ProduitProducteur->Delete();
                $Producteur->Delete();
            }

            $Notifications->IdDestinataireNotification = $Id;
            $Notifications->Delete();

            $User->EmailUser = $_SESSION['user']['Email'];
            $User->Delete();

            header('Refresh:1.5;/User/Deconnexion');
            echo "Compte supprimé avec succès.";
            exit();
        }

        if (isset($_POST['ModifMdp'])) {
            $datas = $this->validate($_POST, ['CurrentMdp', 'NewMdp', 'ConfirmNewMdp']);

            if ($datas) {
                $user = new UserModel();

                $user->IdUser = $_SESSION['user']['Id'];
                $mdp = $user->Find("MdpUser", "Fetch");

                if (password_verify($datas['CurrentMdp'], $mdp['MdpUser'])) {
                    if ($datas['NewMdp'] === $datas['ConfirmNewMdp']) {
                        if($datas['NewMdp'] !== $datas['CurrentMdp']){
                            $user->MdpUser = password_hash($datas['NewMdp'], PASSWORD_ARGON2ID);
                            $user->Where($user->IdUser);
                            $user->Update();
    
                            header('Refresh:1; /User/Deconnexion');
                            echo "Mot de passe changé avec succès, veuillez vous reconnecter.";
                            exit();
                        } else {
                            ExceptionHandler::SetUserError('Le nouveau mot de passe ne peut pas être identique à l\'ancien');
                        }
                    } else {
                        ExceptionHandler::SetUserError('Les 2 mdp ne correspondent pas');
                    }
                } else {
                    ExceptionHandler::SetUserError('Mdp actuel incorrect');
                }
            } else {
                ExceptionHandler::SetUserError('Veuillez remplir tous les champs');
            }
            $errors = ExceptionHandler::GetUserError();
        }


        switch ($_SESSION['user']['RoleUser']) {
            case "Adherent":
                $NewUser = new AdherentModel();
                $NewUser->MailAdherent = $_SESSION['user']['Email'];
                break;
            case "Producteur":
                $NewUser = new ProducteurModel();
                $NewUser->MailProducteur = $_SESSION['user']['Email'];
                break;
        }

        $Infos = $NewUser->Find('*', 'Fetch');;
        ViewController::Set('title', 'Profile');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        ViewController::Set('Reglement', $Reglement);
        ViewController::Set('Infos', $Infos);
        ViewController::Set('errors', $errors);
        ViewController::Display('ProfileView');
    }


    // Fonction pour MAJ le profil adherent ou producteur

    private function UpdateProfil(array|string $datas, object $object, array $properties, string $header): bool
    {

        if (empty($datas)) {
            return false;
        } else {
            $idUser = $_SESSION['user']['IdRole'];
            $keys = array_values($datas);

            for ($i = 0; $i != (count($properties) - 1); $i++) {
                $cleanProp = stripslashes($properties[$i]);
                $object->$cleanProp = $keys[$i];
            }

            $object->Where($idUser);

            $object->Update();
            header('Refresh:1;' . $header);
            echo "Modifié avec succès";
            exit();
        }
        return true;
    }

    //fonction pour se déconnecté

    // Déconnection de l'utilisateur
    public function Deconnexion(): void
    {
        session_destroy();
        // A la déconnection renvoyer a la page d'acceuil
        header('Location: /');
        exit();
    }
}
