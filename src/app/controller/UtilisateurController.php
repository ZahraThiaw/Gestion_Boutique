<?php

namespace App\App\Controller;

use App\Core\Controller;
use App\App\App;
use App\Core\Validator;
use App\Core\Securite\SecurityDatabase;

class UtilisateurController extends Controller {
    private $utilisateurModel;
    private $detteModel;
    private $validator;
    private $securityDatabase;

    public function __construct() {
        $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        $this->detteModel = App::getInstance()->getModel("dette");
        $this->validator = new Validator();
        $this->securityDatabase = new SecurityDatabase(App::getInstance()->getDatabase());
    }

    public function index() {
        $this->renderView('login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            //var_dump($data);
            $rules = [
                'email' => 'email',
                'password' => 'password'
            ];

            $this->validator->validate($data, $rules);

            if ($this->validator->hasErrors()) {
                $errors = $this->validator->getErrors();
                $this->renderView('login', ['errors' => $errors]);
                return;
            }

            if ( 
                $data['email']==='fatimatathiaw6@gmail.com' && $data['password']==='fatima'
                //$this->securityDatabase->login($data['email'], $data['password'])
            ) {
                //$roles = $this->securityDatabase->getRoles();
                $roles = 'Boutiqier';
                if (!empty($roles)) {
                    //$role = $roles[0]->getLibelle();
                    $role = 'Boutiqier';

                    if ($role === 'Boutiqier') {
                        header('Location: /boutiquier');
                        exit();
                    } elseif ($role === 'Client') {
                        header('Location: /Client');
                        exit();
                    } else {
                        $this->renderView('login', ['errors' => ['Role inconnu.']]);
                        return;
                    }
                } else {
                    $this->renderView('login', ['errors' => ['Impossible de récupérer le rôle de l\'utilisateur.']]);
                    return;
                }
            } else {
                $this->renderView('login', ['errors' => ['Email ou mot de passe incorrect.']]);
                return;
            }
        } else {
            $this->renderView('login');
        }
    }



    public function saveClient() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telephone' => $_POST['telephone'] ?? '',
                'motdepasse' => password_hash("passer123", PASSWORD_BCRYPT),  // Hachage du mot de passe
                'rolesId' => 2
            ];

            // Gérer le téléchargement de l'image
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $imageName = $this->uploadImage($_FILES['photo']);
                if ($imageName) {
                    $data['photo'] = $imageName;
                }
            }

            // Valider les données avec le validateur existant dans votre contrôleur
            $this->validator->validate($data, [
                'nom' => ['required' => true],
                'prenom' => ['required' => true],
                'email' => ['required' => true, 'email' => true, 'unique' => 'email'],
                'telephone' => ['required' => true, 'phone' => true, 'unique' => 'telephone'],
            ], $this->utilisateurModel);

            // Gérer les erreurs de validation
            if ($this->validator->hasErrors()) {
                $errors = $this->validator->getErrors();

                // Sauvegarder les données valides dans la session
                $_SESSION['valid_data'] = $data;

                // Passer les erreurs à la vue pour les afficher dans le formulaire
                $this->renderView('boutiquier', ['errors' => $errors]);
                return;
            }

            // Si aucune erreur, sauvegarder les données de l'utilisateur
            $this->utilisateurModel->save($data);

            unset($_SESSION['valid_data']);

            $this->renderView('boutiquier', ['success' => 'Client enregistré avec succès.']);

            $this->redirect('/boutiquier');
        }
    }
    
    
    

    private function uploadImage($file) {
        $targetDir = '../public/images/uploads/';
        
        // Créer le répertoire si nécessaire
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
    
        $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $uniqueName = uniqid('img_', true) . '.' . $imageFileType;
        $targetFile = $targetDir . $uniqueName;
    
        // Vérifier si le fichier est une image réelle
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            return false;
        }
    
        // Vérifier la taille du fichier (ex: 5MB maximum)
        if ($file['size'] > 5000000) {
            return false;
        }
    
        // Autoriser certains formats de fichier
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            return false;
        }
    
        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $uniqueName;
        }
    
        return false;
    }
    

    // public function searchByPhone() {
        
    //     $telephone = $_REQUEST['telephone'] ?? null;
        

    //     if ($telephone) {
            
    //         $Clients = $this->utilisateurModel->findByTelephone($telephone);
    //         //var_dump($Clients);

    //     $this->renderView('boutiquier', ['Clients' => [$Clients]]);
    //     } else {
    //         $this->renderView('boutiquier', ['error' => 'Veuillez entrer un numéro de téléphone.']);
    //     }
    // }


    // public function searchByPhone() {

    //     $telephone = $_REQUEST['telephone'] ?? null;
        
    //     if ($telephone) {
    //         $Clients = $this->utilisateurModel->findBy('telephone', $telephone);
    //         $Dettes = $this->detteModel->findByTel('utilisateursId', $Clients->id);
    //         var_dump($Clients);
    //         var_dump($Dettes);
    //         $this->renderView('boutiquier', ['Clients' => $Clients, 'Dettes' => $Dettes]);
    //     } else {
    //         $this->renderView('boutiquier', ['error' => 'Veuillez entrer un numéro de numéro.']);
    //     }
    // }

    // public function searchByPhone() {
    //     $telephone = $_REQUEST['telephone'] ?? null;
        
    //     if ($telephone) {
    //         $Clients = $this->utilisateurModel->findBy('telephone', $telephone);
    //         var_dump($Clients);
    //         if ($Clients) {
    //             $Dettes = $this->detteModel->findByTel('utilisateursId', $Clients->id);
    //             var_dump($Dettes);
    //             $this->renderView('boutiquier', ['Clients' => $Clients, 'Dettes' => $Dettes]);
    //         } else {
    //             $this->renderView('boutiquier', ['error' => 'Aucun client trouvé.']);
    //         }
    //     } else {
    //         $this->renderView('boutiquier', ['error' => 'Veuillez entrer un numéro de téléphone.']);
    //     }
    // }


    // public function searchByPhone() {
    //     $telephone = $_REQUEST['telephone'] ?? null;
    
    //     if ($telephone) {
    //         $Clients = $this->utilisateurModel->findBy('telephone', $telephone);
    //         $Dettes = $this->detteModel->findByTel('utilisateursId', $Clients->id); // Utilisation de 'id' comme colonne
    //         var_dump($Clients);
    //         var_dump($Dettes);
    //         $this->renderView('boutiquier', ['Clients' => $Clients, 'Dettes' => $Dettes]);
    //     } else {
    //         $this->renderView('boutiquier', ['error' => 'Veuillez entrer un numéro de numéro.']);
    //     }
    // }



    public function searchByPhone() {
        $telephone = $_REQUEST['telephone'] ?? null;
    
        if ($telephone) {
            $Clients = $this->utilisateurModel->findBy('telephone', $telephone);
            if ($Clients) {
                $Dettes = $this->detteModel->findByTel('utilisateursId', $Clients->id);
                $this->renderView('boutiquier', ['Clients' => $Clients, 'Dettes' => $Dettes]);
            } else {
                $this->renderView('boutiquier', ['error' => 'Aucun client trouvé.']);
            }
        } else {
            $this->renderView('boutiquier', ['error' => 'Veuillez entrer un numéro de téléphone.']);
        }
    }
    
    
    
    
    
}




