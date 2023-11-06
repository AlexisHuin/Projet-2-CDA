<?php

namespace Controller;

use Controller\ViewController;

// Produits
use Model\SaisonModel;
use Model\CategorieModel;
use Model\ProduitModel;
// Adherent
use Model\AdherentModel;
// Producteurs
use Model\ProducteurModel;
// Suppression 
use Model\UserModel;
// Traitement des demandes et notifications
use Model\AdminModel;
use Model\ProduitProducteurModel;
use Model\DemandesModel;
use Model\NotificationsModel;

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
                $Log = $Admin->Find('*', 'Fetch');
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
        ViewController::Display('admin/AdminConnexionView');
    }

    public function Dashboard(): void
    {
        $this->connectCheck('admin');

        $Demandes = new DemandesModel();
        if (isset($_POST['Accept'])) {

            $Demandes->EtatDemande = "Accepted";
            $Demandes->Where($_POST['Id']);

            $Demandes->Update();
            $this->TraitementDemande($Demandes->EtatDemande);
        }

        if (isset($_POST['Deny'])) {
            $Demandes->EtatDemande = "Denied";
            $Demandes->Where($_POST['Id']);

            $Demandes->Update();
            $this->TraitementDemande($Demandes->EtatDemande);
        }

        $Liste = $Demandes->getDemandes();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Dashboard');
        ViewController::Set('Demandes', $Liste);
        ViewController::Set('Username', $_SESSION['admin']['Username']);
        ViewController::Display('admin/DashboardView');
    }

    public function AdherentList(): void
    {
        $this->connectCheck('admin');

        $Adherent = new AdherentModel();

        if (isset($_POST['Delete'])) {
            $this->Delete($Adherent, 'IdAdherent', $_POST['Id'], "AdherentList");
        } else {
            $Liste = $Adherent->Find();
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des adherents');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/AdherentListView');
    }

    public function ModifAdherent($id): void
    {
        $this->connectCheck('admin');

        $Adherent = new AdherentModel();

        $Adherent->IdAdherent = $id['id'];

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['NPrenom', 'Tel', 'Mail', 'CP', 'GPS']);
            $this->Update(
                $datas,
                $Adherent,
                ['NomPrenomAdherent', 'PhoneAdherent', 'MailAdherent', 'CodePostalAdherent', 'CoordonneesGPSAdherent', 'RaisonSocialeProducteur'],
                'IdAdherent',
                "AdherentList"
            );
        }

        $Liste = $Adherent->Find('*', 'Fetch');

        ViewController::Init('smarty');
        ViewController::Set('title', 'Modifier l\'adherent');
        ViewController::Set('adherent', $Liste);
        ViewController::Display('admin/ModifAdherentView');
    }

    public function ProducteursList(): void
    {
        $this->connectCheck('admin');

        $Producteur = new ProducteurModel();

        if (isset($_POST['Delete'])) {
            $this->Delete($Producteur, 'IdProducteur', $_POST['Id'], "ProducteursList");
        } else {
            $Liste = $Producteur->Find();
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des producteurs');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/ProducteursListView');
    }

    public function ModifProducteurs($id): void
    {
        $this->connectCheck('admin');

        $Producteur = new ProducteurModel();

        $Producteur->IdProducteur = $id['id'];

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['NPrenom', 'Tel', 'Mail', 'CP', 'GPS', 'RS']);
            $this->Update(
                $datas,
                $Producteur,
                ['NomPrenomProducteur', 'PhoneProducteur', 'MailProducteur', 'CodePostalProducteur', 'CoordonneesGPSProducteur', 'RaisonSocialeProducteur'],
                'IdProducteur',
                "ProducteursList"
            );
        }

        $Liste = $Producteur->Find('*', 'Fetch');

        ViewController::Init('smarty');
        ViewController::Set('title', 'Modifier le producteur');
        ViewController::Set('Producteur', $Liste);
        ViewController::Display('admin/ModifProducteurView');
    }

    public function ProduitsProducteursList($id): void
    {
        $this->connectCheck('admin');

        $ProduitProducteur = new ProduitProducteurModel();

        if (isset($_POST['Delete'])) {
            $this->Delete($ProduitProducteur, 'IdProduitProducteur', $_POST['Id'], "ProducteursList");
        } else {
            $Liste = $ProduitProducteur->getProduitProducteur($id['id']);
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des producteurs');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/ProduitsProducteursListView');
    }

    public function StatsProducteurs(): void
    {
        $this->connectCheck('admin');

        $Producteur = new ProducteurModel();

        $Liste = $Producteur->Find();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des producteurs');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/StatsProducteurView');
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
        }

        ViewController::Init('smarty');
        ViewController::Set('title', 'Liste des produits');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/ProductsListView');
    }

    public function ModifProducts($id): void
    {
        $this->connectCheck('admin');

        $Product = new ProduitModel();

        $Product->IdProduit = $id['id'];

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['Produit', 'Saison', 'Categorie']);
            $this->Update(
                $datas,
                $Product,
                ['Produit', 'Saison', 'Categorie'],
                $Product->IdProduit,
                "ProductsListView"
            );
        }

        $Liste = $Product->getOneProduitInfos($id['id']);

        $Categorie = (new CategorieModel())->Find();
        $Saison = (new SaisonModel())->Find();

        ViewController::Init('smarty');
        ViewController::Set('title', 'Modifier le produit');
        ViewController::Set('Categories', $Categorie);
        ViewController::Set('Saisons', $Saison);
        ViewController::Set('Product', $Liste);
        ViewController::Display('admin/ModifProductsView');
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
        ViewController::Display('admin/AddProductsView');
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

    // PRIVATE FUNCTIONS
    private function TraitementDemande(string $state): void
    {
        $ProduitProducteur = new ProduitProducteurModel();
        $Notifications = new NotificationsModel();

        switch ($_POST['Objet']) {
            case "Prix":
                if ($state === "Accepted") {
                    $ProduitProducteur->Where($_POST['IdProduitProducteur']);
                    $ProduitProducteur->PrixProduitProducteur = $_POST['Prix'];
                    $ProduitProducteur->DateModifPrixProduitProducteur = date('Y-m-d H:i');

                    $ProduitProducteur->Update();
                }

                $Notifications->IdDestinataireNotification = $_POST['IdProd'];
                $Notifications->DateEnvoiNotification = date('Y-m-d H:i');

                if ($state === "Denied") {
                    $Notifications->MotifNotification = "Votre demande concernant la modification du prix de " . $_POST['DesignationProduit'] . " a été refusée.";
                } else {
                    $Notifications->MotifNotification = "Votre demande concernant la modification du prix de " . $_POST['DesignationProduit'] . " a été acceptée.";
                }

                $Notifications->Save();
                break;

            case "Ajout":
                if ($state === "Accepted") {
                    $ProduitProducteur->Where($_POST['IdProduitProducteur']);
                    $ProduitProducteur->IsValidateProduitProducteur = true;

                    $ProduitProducteur->Update();
                }

                $Notifications->IdDestinataireNotification = $_POST['IdProd'];
                $Notifications->DateEnvoiNotification = date('Y-m-d H:i');

                if ($state === "Denied") {
                    $Notifications->MotifNotification = "Votre demande concernant l'ajout du produit " . $_POST['DesignationProduit'] . " a été refusée.";
                } else {
                    $Notifications->MotifNotification = "Votre demande concernant l'ajout du produit " . $_POST['DesignationProduit'] . " a été acceptée.";
                }

                $Notifications->Save();
                break;

            case "Achat":
                break;
        }

        $mailto = [
            "Email" => $_POST['EmailProd'],
            "Subject" => $state,
            "Motif" => $Notifications->MotifNotification
        ];
        echo json_encode($mailto);


        //header('Location:mailto:' . $mailto['Email'] . '?subject=' . $mailto['Subject'] . '&body=' . $mailto['Motif']);
        exit();
    }

    private function Update(array|string $datas, object $object, array $properties, string $whereClause, string $header): bool
    {
        if (empty($datas)) {
            return false;
        } else {

            $keys = array_values($datas);

            for ($i = 0; $i != (count($keys) - 1); $i++) {
                $cleanProp = stripslashes($properties[$i]);
                $object->$cleanProp = $keys[$i];
            }

            $object->Where($object->$whereClause);

            $object->Update();
            header('Refresh:1;/Admin/' . $header);
            echo "Modifié avec succès";
            exit();
        }
        return true;
    }

    private function Delete(object $object, string|array $property, string|array $datas, string $header, $IsUser = false)
    {
        if (is_array($property) && is_array($datas)) {
            $keys = array_values($datas);
            for ($i = 0; $i < count($property); $i++) {
                $object->$property[$i] = $keys[$i];
            }
        } else {
            $object->$property = $datas;
        }

        if ($IsUser) {
            $Liste = $object->Find('*', 'Fetch');
            in_array('MailProducteur', array_keys($Liste)) ? $Email = $Liste['MailProducteur'] : $Email = $Liste['MailAdherent'];

            $User = new UserModel();
            $UserToDelete = $User->JoinUsers($_POST['Role'], $Email);
            $User->EmailUser = $UserToDelete['EmailUser'];

            $User->Delete();
        }
        $object->Delete();

        header('Refresh:1;/Admin/' . $header);
        echo "Supprimé avec succès.";
        exit();
    }
}
