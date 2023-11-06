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

                            $Adherent->NomPrenomAdherent = htmlspecialchars($datas['Nom'] . " " . ($datas['Prenom']));
                            $Adherent->PhoneAdherent = htmlspecialchars($datas['Tel']);
                            $Adherent->CoordonneesGPSAdherent = htmlspecialchars($datas['GPS']);
                            $Adherent->CodePostalAdherent = htmlspecialchars($datas['CodePostal']);
                            // explique le (new dateTime())
                            $Adherent->DateDebutAdherent = (new DateTime())->format('Y-m-d');
                            $Adherent->MailAdherent = htmlspecialchars($datas['Email']);
                            $IdRole = $Adherent->Save();
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
            var_dump($errors);
        }

        // Initialisation de la vue (Smarty)
        ViewController::Init('smarty');
        ViewController::Set('title', 'Login');
        ViewController::Display('LoginView');
    }
    public function Profile(): void
    {

        $this->connectCheck('user');

               $Reglement = InfosReglementController::GetOneInfosReglement();
          
           
        if (isset($_POST["Confirmation"])) {

            $datas = $this->validate($_POST, ['Titulaire', 'NumeroCB', 'DateExpiration', 'CCV']);
            if ($datas) {
                InfosReglementController::AddInfosReglement($datas);
            } else {
                ExceptionHandler::SetUserError("Veuillez remplir tout les champs");
            }
        }

        if (isset($_POST["modification"])) {
            if ($_SESSION['user']['RoleUser'] === "Adherent") 
            {
                $NewUser = new AdherentModel();
                $datas = $this->validate($_POST, ['NomPrenomAdherent', 'PhoneAdherent', 'CodePostalAdherent', 'CoordonneesGPSAdherent']);
                $this->UpdateProfil($datas, $NewUser, ['NomPrenomAdherent', 'PhoneAdherent', 'CodePostalAdherent', 'CoordonneesGPSAdherent'], '/User/Profile');
        }
            else if ($_SESSION['user']['RoleUser'] === "Producteur") 
            { 
                $NewUser = new ProducteurModel();
                $datas = $this->validate($_POST, ['NomPrenomProducteur', 'PhoneProducteur', 'CodePostalProducteur', 'CoordonneesGPSProducteur', 'RaisonSocialeProducteur']);
                $this->UpdateProfil($datas, $NewUser, ['NomPrenomProducteur', 'PhoneProducteur', 'CodePostalProducteur', 'CoordonneesGPSProducteur', 'RaisonSocialeProducteur'], '/User/Profile');
    }
          
            } else {
                ExceptionHandler::SetUserError("Veuillez remplir tout les champs");
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
        $Infos = $NewUser->Find('*', 'Fetch');

        ViewController::Init('smarty');
        ViewController::Set('URI', $_SERVER['REQUEST_URI']);
        ViewController::Set('title', 'Profile');
        ViewController::Set('SessionInfo', $_SESSION['user']);
        // ViewController::Set('idAdherent', $idAdherent);
        ViewController::Set('Reglement', $Reglement);
        ViewController::Set('Infos', $Infos);
        ViewController::Display('ProfileView');
    }

    // private function UpdateProfil($datas): void
    // {
    //     $idUser = $_SESSION['user']['IdRole'];

    //     $AdherentModif = new AdherentModel();
    //     $AdherentModif->NomPrenomAdherent = $datas['NomPrenomAdherent'];
    //     $AdherentModif->PhoneAdherent = $datas['PhoneAdherent'];
    //     $AdherentModif->CodePostalAdherent = $datas['CodePostalAdherent'];
    //     $AdherentModif->CoordonneesGPSAdherent = $datas['CoordonneesGPSAdherent'];
    //     $AdherentModif->Where($idUser);
    //     $AdherentModif->Update();
    //     header('Refresh:1;/User/Profile');
    //     echo 'Modifications effectuées';
    //     exit();
    // } 

    private function UpdateProfil(array|string $datas, object $object, array $properties, string $header): bool
    {

        if (empty($datas)) {
            return false;
        } else {
            $idUser = $_SESSION['user']['IdRole'];
            $keys = array_values($datas);

            for ($i = 0; $i != (count($keys) - 1); $i++) {
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


    // Déconnection de l'utilisateur
    public function Deconnexion(): void
    {
        session_destroy();
        // A la déconnection renvoyer a la page d'acceuil
        header('Location: /');
        exit;
    }
}



 // if (isset($_FILES["ImageProduitProducteur"]) && $_FILES["ImageProduitProducteur"]["error"] == 0) {
        //     // Get la taille et le type du fichier
        //     $file_size = $_FILES["ImageProduitProducteur"]["size"];
        //     $file_type = $_FILES["ImageProduitProducteur"]["type"];

        //     // restreint la taille du fichier
        //     if ($file_size < 1000000) { // 1 MB        
        //         // Vérifie que le type du fichier correspond bien
        //         if ($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/webp") {
        //             $extension = pathinfo($_FILES['ImageProduitProducteur']['name'], PATHINFO_EXTENSION);
        //             // Génère un fichier unique
        //             $new_filename = uniqid() . "." . $extension;
        //             // Set le chemin d'upload du fichier
        //             $upload_path = "assets/images/" . $new_filename;
        //             // Déplace le nouveau fichier vers sa destination et vérifie que tout s'est bien passé
        //             if (move_uploaded_file($_FILES["ImageProduitProducteur"]["tmp_name"], $upload_path)) {

        //                 // je récupére les données envoyer depuis ma page de formulaire
        //                 if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //                     $idProduit = $_POST["produit"];
        //                     $DesignationProduitProducteur = $_POST["DesignationProduitProducteur"];
        //                     $PrixProduitProducteur = $_POST["PrixProduitProducteur"];
        //                     $DetailsProduitProducteur = $_POST["DetailsProduitProducteur"];
        //                     $QuantiteProduitProducteur = $_POST["QuantiteProduitProducteur"];
        //                     $ImageProduitProducteur = $upload_path;


        //                     // je vérifie si les champs sont vides
        //                     if (
        //                         empty($DesignationProduitProducteur) &&
        //                         empty($PrixProduitProducteur) &&
        //                         empty($DetailsProduitProducteur) &&
        //                         empty($QuantiteProduitProducteur)
        //                     ) {
        //                         die("Tous les champs du formulaire doivent être remplis|| "); 
        //                     }
