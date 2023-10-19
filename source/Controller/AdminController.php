<?php

namespace Controller;

use Controller\ViewController;
use Model\AdherentModel;
use Model\ProducteurModel;
use Model\ProduitModel;
use Model\AdminModel;

// Classe UserController héritant de MainController
class AdminController extends MainController
{
    public function Connexion(): void
    {
        if (isset($_SESSION['admin'])) {
            header('Location: /Admin/Dashboard');
            exit();
        }

        if (isset($_POST['AdminLogin'])) {

            $datas = $this->validate($_POST, ['Username', 'Pass']);

            if ($datas) {
                $Admin = new AdminModel();

                if (!preg_match("/^\pL+([a-zA-Z- ']\pL+)*$/u", $datas["Username"])) {
                    ExceptionHandler::SetUserError("Username invalide");
                }

                $errors = ExceptionHandler::GetUserError();
                if (count($errors) == 0) {
                    $Admin->UsernameAdmin = $datas['Username'];
                }

                // Rechercher l'utilisateur dans la base de données
                $Log = $Admin->FindOne();
                if ($Log) {
                    if (password_verify($_POST['Pass'], $Log['MdpAdmin'])) {
                        $AdminArr = [
                            'Id' => $Log['IdAdmin'],
                            'Username' => $Admin->UsernameAdmin,
                        ];
                        SessionController::Set("admin", $AdminArr);
                        SessionController::Save();
                        header('location:/Admin/Dashboard ');
                        exit;
                    } else {
                        ExceptionHandler::SetUserError("Informations incorrectes");
                    }
                } else {
                    ExceptionHandler::SetUserError("Informations incorrectes");
                }
            }
            $errors = ExceptionHandler::GetUserError();
            var_dump($errors);
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Admin Login');
        ViewController::Display('AdminConnexionView');
    }
    public function Dashboard(): void
    {
        $this->connectCheck('admin');

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        // Créer une table Demande contenant : IdDemande, ProducteurDemande, PrixDemande, PrixActuelDemande, ProduitDemande, EtatDemande 
        // ViewController::Set('Demandes', )
        ViewController::Set('Username', $_SESSION['admin']['Username']);
        ViewController::Display('DashboardView');
    }

    public function AdherentsList(): void
    {
        $this->connectCheck('admin');

        $Adherents = new AdherentModel();

        if (isset($_POST['Delete'])) {
            $Adherents->IdAdherents = $_POST['Id'];
            $Adherents->Delete();
            header('Refresh:1;/Admin/Dashboard');
            echo "Supprimé avec succès.";
            exit();
        } else {
            $Liste = $Adherents->Find();
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('AdherentsListView');
    }

    public function ModifAdherents($id): void
    {

        $Adherents = new AdherentModel();

        $Adherents->IdAdherents = $id['id'];

        $Liste = $Adherents->FindOne();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        ViewController::Set('adherent', $Liste);
        ViewController::Display('ModifAdherentsView');
    }

    public function ProducteursList(): void
    {
        $this->connectCheck('admin');

        $Producteur = new ProducteurModel();

        if (isset($_POST['Delete'])) {
            $Producteur->IdProducteur = $_POST['Id'];
            $Producteur->Delete();
            header('Refresh:1;/Admin/Dashboard');
            echo "Supprimé avec succès.";
            exit();
        } else {
            $Liste = $Producteur->Find();
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('ProducteursListView');
    }

    public function ModifProducteurs($id): void
    {

        $Producteur = new ProducteurModel();

        $Producteur->IdProducteur = $id['id'];

        $Liste = $Producteur->FindOne();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        ViewController::Set('Producteur', $Liste);
        ViewController::Display('ModifProducteurView');
    }

    public function ProductsList(): void
    {
        $this->connectCheck('admin');

        $Product = new ProduitModel();

        if (isset($_POST['Delete'])) {
            $Product->IdProduit = $_POST['Id'];
            $Product->Delete();
            header('Refresh:1;/Admin/Dashboard');
            echo "Supprimé avec succès.";
            exit();
        } else {
            $Liste = $Product->getAllProduitsInfos();
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('ProductsListView');
    }

    public function ModifProducts($id): void
    {

        $Product = new ProduitModel();

        $Liste = $Product->getOneProduitInfos($id['id']);

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        ViewController::Set('Product', $Liste);
        ViewController::Display('ModifProductsView');
    }

    // public function Inscription()
    // {
    //     if(isset($_POST['InscriptionAdmin'])){
    //         $Admin = new AdminModel();
    //         $Admin->UsernameAdmin = $_POST['Username'];
    //         $Admin->MdpAdmin = password_hash($_POST['Pass'], PASSWORD_ARGON2ID);
    //         $Admin->Save();
    //     }


    //     echo '
    //     <form method="POST">
    //         <input type="text" name="Username" placeholder="Username">
    //         <input type="password" name="Pass" placeholder="Mot de passe">
    //         <button type="submit" name="InscriptionAdmin">Se Connecter</button>
    //     </form>';
    // }
}
