<?php
namespace App\Core;

class File {
    private $imageTypes = ['jpg', 'jpeg', 'png', 'gif'];
    private $dir;

    public function __construct($dir = '../public/images/uploads/') {
        $this->dir = $dir;

        // Créer le répertoire si nécessaire
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0777, true);
        }
    }

    public function load($file) {
        $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $uniqueName = uniqid('img_', true) . '.' . $imageFileType;
        $targetFile = $this->dir . $uniqueName;

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
        if (!in_array($imageFileType, $this->imageTypes)) {
            return false;
        }

        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $uniqueName;
        }

        return false;
    }
}
