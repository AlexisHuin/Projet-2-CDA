<?php

namespace Controller;

use Controller\ViewController;
use Controller\UserController;

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
use Model\InfosReglementModel;
use Model\PanierModel;
use Model\FactureModel;
use Model\CommandesModel;
// Traitement des demandes et notifications
use Model\AdminModel;
use Model\BundleModel;
use Model\ProduitProducteurModel;
use Model\DemandesModel;
use Model\NotificationsModel;

// Classe UserController héritant de MainController
class AdminController extends MainController
{
    public function Connexion(): void
    {
        $this->connectCheck('admin', "", "/Admin/Dashboard", true);

        $errors = [];

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
        }
        ViewController::Set('errors', $errors);
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
            $this->Delete($Adherent, 'IdAdherent', $_POST['Id'], "AdherentList", true);
        } else {
            $Liste = $Adherent->Find();
        }

        ViewController::Set('title', 'Liste des adherents');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/AdherentsListView');
    }

    public function ModifAdherent($id): void
    {
        $this->connectCheck('admin');

        $User = new UserModel();
        $Adherent = new AdherentModel();
        $Adherent->IdAdherent = $id['id'];

        //! Cette horreur aurait pu être évitée si l'on avait inclut l'idUser dans les tables adherent et producteur
        $Liste = $Adherent->Find('*', 'Fetch');
        $User->EmailUser = $Liste['MailAdherent'];
        $UserData = $User->Find('IdUser', 'Fetch');

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['NPrenom', 'Tel', 'Mail', 'CP', 'GPS']);
            $this->Update(
                $datas,
                $Adherent,
                ['NomPrenomAdherent', 'PhoneAdherent', 'MailAdherent', 'CodePostalAdherent', 'CoordonneesGPSAdherent'],
                'IdAdherent',
                "AdherentList",
                true,
                $UserData['IdUser']
            );
        }

        ViewController::Set('title', 'Modifier l\'adherent');
        ViewController::Set('adherent', $Liste);
        ViewController::Display('admin/ModifAdherentView');
    }

    public function ProducteursList(): void
    {
        $this->connectCheck('admin');

        $Producteur = new ProducteurModel();

        if (isset($_POST['Delete'])) {
            $this->Delete($Producteur, 'IdProducteur', $_POST['Id'], "ProducteursList", true);
        } else {
            $Liste = $Producteur->Find();
        }

        ViewController::Set('title', 'Liste des producteurs');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/ProducteursListView');
    }

    public function ModifProducteurs($id): void
    {
        $this->connectCheck('admin');

        $User = new UserModel();
        $Producteur = new ProducteurModel();
        $Producteur->IdProducteur = $id['id'];

        //! Cette horreur aurait pu être évitée si l'on avait inclut l'idUser dans les tables adherent et producteur
        $Liste = $Producteur->Find('*', 'Fetch');
        $User->EmailUser = $Liste['MailProducteur'];
        $UserData = $User->Find('IdUser', 'Fetch');

        if (isset($_POST['Update'])) {
            $datas = $this->validate($_POST, ['NPrenom', 'Tel', 'Mail', 'CP', 'GPS', 'RS']);
            $this->Update(
                $datas,
                $Producteur,
                ['NomPrenomProducteur', 'PhoneProducteur', 'MailProducteur', 'CodePostalProducteur', 'CoordonneesGPSProducteur', 'RaisonSocialeProducteur'],
                'IdProducteur',
                "ProducteursList",
                true,
                $UserData['IdUser']
            );
        }

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
            $Liste = $ProduitProducteur->getProduitProducteur($id['id'], true);
        }

        ViewController::Set('title', 'Liste des producteurs');
        ViewController::Set('Liste', $Liste);
        ViewController::Display('admin/ProduitsProducteursListView');
    }

    // public function StatsProducteurs(): void
    // {
    //     $this->connectCheck('admin');

    //     $Producteur = new ProducteurModel();

    //     $Liste = $Producteur->Find();;
    //     ViewController::Set('title', 'Liste des producteurs');
    //     ViewController::Set('Liste', $Liste);
    //     ViewController::Display('admin/StatsProducteurView');
    // }

    public function ProductsList(): void
    {
        $this->connectCheck('admin');

        $Product = new ProduitModel();

        if (isset($_POST['Delete'])) {
            $this->Delete($Product, 'IdProduit', $_POST['Id'], "ProductsList");
        } else {
            $Liste = $Product->getAllProduitsInfos();

            // Trie les éléments de Liste via leur ID de façon décroissante
            usort($Liste, function ($a, $b) {
                return $b['IdProduit'] - $a['IdProduit'];
            });
        };
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
                ['DesignationProduit', 'IdSaisonProduit', 'IdCategorieProduit'],
                "IdProduit",
                "ProductsList"
            );
        }

        $Liste = $Product->getOneProduitInfos($id['id']);

        $Categorie = (new CategorieModel())->Find();
        $Saison = (new SaisonModel())->Find();;
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
        $Bundle = new BundleModel();

        switch ($_POST['Objet']) {
            case "Prix":
                if ($state === "Accepted") {
                    $ProduitProducteur->Where($_POST['IdProduitProducteur']);
                    $ProduitProducteur->PrixProduitProducteur = $_POST['Prix'];
                    $ProduitProducteur->IsValidateProduitProducteur = true;
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
                $Notifications->DateEnvoiNotification = date('d-M-Y H:i');

                if ($state === "Denied") {
                    $Notifications->MotifNotification = "Votre demande concernant l'ajout du produit " . $_POST['DesignationProduit'] . " a été refusée.";
                } else {
                    $Notifications->MotifNotification = "Votre demande concernant l'ajout du produit " . $_POST['DesignationProduit'] . " a été acceptée.";
                }

                $Notifications->Save();
                break;

            case "Bundle":
                if ($state === "Accepted") {
                    $Bundle->Where($_POST['IdProduitProducteur']);
                    $Bundle->IsValidateBundle = true;

                    $Bundle->Update();
                }

                $Notifications->IdDestinataireNotification = $_POST['IdProd'];
                $Notifications->DateEnvoiNotification = date('d-M-Y H:i');

                if ($state === "Denied") {
                    $Notifications->MotifNotification = "Votre demande concernant la création de votre bundle a été refusée.";
                } else {
                    $Notifications->MotifNotification = "Votre demande concernant la création de votre bundle a été acceptée.";
                }

                $Notifications->Save();
                break;
            case "Achat":
                break;
        }

        // $mailto = [
        //     "Email" => $_POST['EmailProd'],
        //     "Subject" => $state,
        //     "Motif" => $Notifications->MotifNotification
        // ];
        // echo json_encode($mailto);

        header('Location: /Admin/Dashboard');
        exit();
    }

    private function Update(array|string $datas, object $object, array $properties, string $whereClause, string $header, bool $isUser = false, string|int $IdUser = ""): bool
    {
        if (empty($datas)) {
            return false;
        } else {
            $keys = array_values($datas);

            for ($i = 0; $i != count($keys); $i++) {
                $cleanProp = stripslashes($properties[$i]);
                $object->$cleanProp = $keys[$i];
            }

            if ($isUser) {
                $User = new UserModel();

                if (is_a($object, 'Model\AdherentModel')) {
                    $Email = $object->MailAdherent;
                    $NomPrenom = explode(' ', $object->NomPrenomAdherent);
                } else if (is_a($object, 'Model\ProducteurModel')) {
                    $Email = $object->MailProducteur;
                    $NomPrenom = explode(' ', $object->NomPrenomProducteur);
                }

                $Nom = $NomPrenom[0];
                $Prenom = $NomPrenom[1];

                $User->EmailUser = $Email;
                $User->UsernameUser = $Nom . "." . $Prenom;
                $User->Where($IdUser);
                $User->Update();
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
            if (is_a($object, "Model\AdherentModel")) {
                $infosReglement = new InfosReglementModel();
                $Panier = new PanierModel();
                $Commandes = new CommandesModel();
                $Facture = new FactureModel();

                $infosReglement->IdAdherentInfosReglement =
                    $Panier->IdAdherentsPanier =
                    $Facture->IdAdherentFacture =
                    $Commandes->IdAdherentCommande =
                    $object->IdAdherent;

                $infosReglement->Delete();
                $Panier->Delete();
                $Facture->Delete();
                $Commandes->Delete();
            } else if (is_a($object, "Model\ProducteurModel")) {

                $ProduitProducteur = new ProduitProducteurModel();
                $Bundle = new BundleModel();
                $Demandes = new DemandesModel();

                $Bundle->IdProducteurBundle =
                    $ProduitProducteur->IdProducteurProduitProducteur =
                    $Demandes->IdUserDemande =
                    $object->IdProducteur;

                $Demandes->Delete();
                $Bundle->Delete();
                $ProduitProducteur->Delete();
            }

            $Liste = $object->Find('*', 'Fetch');
            in_array('MailProducteur', array_keys($Liste)) ? $Email = $Liste['MailProducteur'] : $Email = $Liste['MailAdherent'];

            $User = new UserModel();
            $UserToDelete = $User->JoinUsers($_POST['Role'], $Email);

            $Notifications = new NotificationsModel();
            $Notifications->IdDestinataireNotification = $UserToDelete['IdUser'];
            $Notifications->Delete();

            $User->EmailUser = $UserToDelete['EmailUser'];
            $object->Delete();
            $User->Delete();
        }

        // TODO Ajouter possibilité de supprimer un bundle pour l'admin 
        else {

            $result = [];
            $demandes = new DemandesModel();
            $Bundle = new BundleModel();
            $IdProduitsBundle = $Bundle->Find("IdProduitsBundle, IdBundle");
            $IdProduitsBundleArr = [];

            foreach ($IdProduitsBundle as $ProduitsBundle) {
                array_push($IdProduitsBundleArr, explode(',', $ProduitsBundle['IdProduitsBundle']));
            }

            if (is_a($object, "Model\ProduitProducteurModel")) {
                $result[] = $object->Find('IdProducteurProduitProducteur, ImageProduitProducteur', 'Fetch');

                if (file_exists($result[0]['ImageProduitProducteur']) && $result[0]['ImageProduitProducteur'] !== "assets/images/fruit.jpg") {
                    unlink(DIR_PUBLIC . $result[0]['ImageProduitProducteur']);
                }

                $demandes->IdProduitProducteurDemande = $object->IdProduitProducteur;
                $demandes->Delete();

                foreach ($IdProduitsBundleArr as $key => $Arrays) {
                    foreach ($Arrays as $Id) {
                        if ($Id === $object->IdProduitProducteur) {

                            $Bundle->IdBundle = $IdProduitsBundle[$key]['IdBundle'];
                            $Bundle->Delete();
                            break;
                        }
                    }
                }
            } else if (is_a($object, "Model\ProduitModel")) {
                $ProduitProducteur = new ProduitProducteurModel();
                $ProduitProducteur->IdProduitProduitProducteur = $object->IdProduit;
                $ProduitsToDelete = $ProduitProducteur->Find('IdProduitProducteur,IdProducteurProduitProducteur,ImageProduitProducteur');


                foreach ($ProduitsToDelete as $IdProduitProd) {
                    $result[] = $IdProduitProd['IdProducteurProduitProducteur'];

                    $demandes->IdProduitProducteurDemande = $IdProduitProd['IdProduitProducteur'];
                    $demandes->Delete();

                    foreach ($IdProduitsBundleArr as $key => $Arrays) {
                        foreach ($Arrays as $Id) {
                            if ($Id == $IdProduitProd['IdProduitProducteur']) {


                                $Bundle->IdBundle = $IdProduitsBundle[$key]['IdBundle'];
                                $Bundle->Delete();
                            }
                        }
                    }

                    $ProduitProducteur->IdProduitProducteur = $IdProduitProd['IdProduitProducteur'];

                    if (file_exists($IdProduitProd['ImageProduitProducteur']) && $IdProduitProd['ImageProduitProducteur'] !== "assets/images/fruit.jpg") {
                        unlink(DIR_PUBLIC . $IdProduitProd['ImageProduitProducteur']);
                    }

                    $ProduitProducteur->Delete();
                }
            }

            $Notifications = new NotificationsModel();
            $Producteur = new ProducteurModel();
            $User = new UserModel();

            foreach ($result as $IdUser) {
                if (isset($IdUser['IdProducteurProduitProducteur'])) {
                    $Producteur->IdProducteur = $IdUser['IdProducteurProduitProducteur'];
                } else {
                    $Producteur->IdProducteur = $IdUser;
                }

                $MailProd = $Producteur->Find('MailProducteur', 'Fetch');
                $User->EmailUser = $MailProd['MailProducteur'];
                $Id = $User->Find('IdUser', 'Fetch');

                $Notifications->IdDestinataireNotification = $Id['IdUser'];
                $Notifications->MotifNotification = "L'un de vos produit a été supprimé par l'administrateur. Si vous pensez qu'il s'agit d'une erreur, contactez nous depuis la page contact.";
                $Notifications->DateEnvoiNotification = date('d-M-Y H:i');

                $Notifications->Save();
            }
            $object->Delete();
        }

        header('Refresh:1;/Admin/' . $header);
        echo "Supprimé avec succès.";
        exit();
    }
}
