<?php

namespace Controller;

use Controller\ViewController;

use Model\SaisonModel;
use Model\CategorieModel;
use Model\AdherentModel;
use Model\ProducteurModel;
use Model\ProduitModel;
use Model\AdminModel;
use Model\UserModel;

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
            $Liste = $Adherents->FindOne();
            
            $User = new UserModel();
            $UserToDelete = $User->JoinUsers($_POST['Role'], $Liste['MailProducteur']);
            $User->EmailUser = $UserToDelete['EmailUser'];

            $User->Delete();
            $Adherents->Delete();
            
            header('Refresh:1;/Admin/Dashboard');
            echo "Supprimé avec succès.";
            exit();
        } else {
            $Liste = $Adherents->Find();
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des adherents');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('AdherentsListView');
    }

    public function ModifAdherents($id): void
    {
        $this->connectCheck('admin');

        $Adherents = new AdherentModel();

        $Adherents->IdAdherents = $id['id'];

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['NPrenom', 'Tel', 'Mail', 'CP', 'GPS']);

            if ($datas) {
                $Adherents->NomPrenomAdherents = $datas['NPrenom'];
                $Adherents->PhoneAdherents = $datas['Tel'];
                $Adherents->MailAdherents = $datas['Mail'];
                $Adherents->CodePostalAdherents = $datas['CP'];
                $Adherents->CoordonneesGPSAdherents = $datas['GPS'];

                $Adherents->Where($Adherents, $Adherents->IdAdherents);

                $Adherents->Update();
                header('Refresh:1;/Admin/AdherentsList');
                echo "Adherent modifié avec succès";
                exit();
            }
        }

        $Liste = $Adherents->FindOne();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Modifier l\'adherent');
        ViewController::Set('adherent', $Liste);
        ViewController::Display('ModifAdherentsView');
    }

    public function ProducteursList(): void
    {
        $this->connectCheck('admin');

        $Producteur = new ProducteurModel();

        if (isset($_POST['Delete'])) {
            $Producteur->IdProducteur = $_POST['Id'];
            $Liste = $Producteur->FindOne();
            
            $User = new UserModel();
            $UserToDelete = $User->JoinUsers($_POST['Role'], $Liste['MailProducteur']);
            $User->EmailUser = $UserToDelete['EmailUser'];

            $User->Delete();
            $Producteur->Delete();

            header('Refresh:1;/Admin/Dashboard');
            echo "Supprimé avec succès.";
            exit();
        } else {
            $Liste = $Producteur->Find();
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des producteurs');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('ProducteursListView');
    }

    public function ModifProducteurs($id): void
    {
        $this->connectCheck('admin');

        $Producteur = new ProducteurModel();

        $Producteur->IdProducteur = $id['id'];

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['NPrenom', 'Tel', 'Mail', 'CP', 'GPS', 'RS']);

            if ($datas) {
                $Producteur->NomPrenomProducteur = $datas['NPrenom'];
                $Producteur->PhoneProducteur = $datas['Tel'];
                $Producteur->MailProducteur = $datas['Mail'];
                $Producteur->CodePostalProducteur = $datas['CP'];
                $Producteur->CoordonneesGPSProducteur = $datas['GPS'];
                $Producteur->RaisonSocialeProducteur = $datas['RS'];

                $Producteur->Where($Producteur, $Producteur->IdProducteur);

                $Producteur->Update();
                header('Refresh:1;/Admin/ProducteursList');
                echo "Producteur modifié avec succès";
                exit();
            }
        }

        $Liste = $Producteur->FindOne();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Modifier le producteur');
        ViewController::Set('Producteur', $Liste);
        ViewController::Display('ModifProducteurView');
    }

    public function StatsProducteurs(): void
    {
        // Un tableau contenant chaque producteurs avec le nombre de produits qu'ils ont vendus et la somme de leurs ventes
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

            // Trie les éléments de Liste via leur ID de façon décroissante
            usort($Liste, function ($a, $b) {
                return $b['IdProduit'] - $a['IdProduit'];
            });
            // array_multisort($Liste, SORT_NUMERIC, SORT_DESC);
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des produits');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('ProductsListView');
    }

    public function ModifProducts($id): void
    {
        $this->connectCheck('admin');

        $Product = new ProduitModel();

        $Product->IdProduit = $id['id'];

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['Produit', 'Saison', 'Categorie']);

            if ($datas) {
                $Product->DesignationProduit = $datas['Produit'];
                $Product->IdSaisonProduit = $datas['Saison'];
                $Product->IdCategorieProduit = $datas['Categorie'];

                $Product->Where($Product, $Product->IdProduit);

                $Product->Update();
                header('Refresh:1;/Admin/ProductsList');
                echo "Produit modifié avec succès";
                exit();
            }
        }

        $Liste = $Product->getOneProduitInfos($id['id']);

        $Categorie = (new CategorieModel())->Find();
        $Saison = (new SaisonModel())->Find();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Modifier le produit');
        ViewController::Set('Categories', $Categorie);
        ViewController::Set('Saisons', $Saison);
        ViewController::Set('Product', $Liste);
        ViewController::Display('ModifProductsView');
    }

    public function AddProduct(): void
    {
        $this->connectCheck('admin');

        if (isset($_POST['Add'])) {
            $datas = $this->validate($_POST, ['Produit', 'Saison', 'Categorie']);

            if ($datas) {
                $Product = new ProduitModel;
                $Product->DesignationProduit = ucwords($datas['Produit']);
                $Product->IdSaisonProduit = $datas['Saison'];
                $Product->IdCategorieProduit = $datas['Categorie'];

                $Product->Save();
                header('Refresh:1;/Admin/ProductsList');
                echo "Produit ajouté avec succès";
                exit();
            }
        }

        $Categorie = (new CategorieModel())->Find();
        $Saison = (new SaisonModel())->Find();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Ajouter un produit');
        ViewController::Set('Categories', $Categorie);
        ViewController::Set('Saisons', $Saison);
        ViewController::Display('AddProductsView');
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
