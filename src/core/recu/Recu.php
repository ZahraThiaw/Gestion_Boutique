<?php
namespace App\Core\Recu;


use Fpdf\Fpdf;

class Recu {
    public function generateRecu(array $data, $outputDir) {
        // Vérifier si le dossier de sortie existe
        if (!is_dir($outputDir)) {
            throw new \Exception("Le dossier de sortie n'existe pas: $outputDir");
        }

        // Vérifier les permissions du dossier de sortie
        if (!is_writable($outputDir)) {
            throw new \Exception("Le dossier de sortie n'est pas accessible en écriture: $outputDir");
        }

        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Titre du reçu
        $pdf->Cell(40, 10, 'Recu de Paiement');

        // Saut de ligne
        $pdf->Ln(20);

        // Informations du client
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, 'Client: ' . $data['prenom'] .' '. $data['nom']);
        $pdf->Ln(10); // Saut de ligne
        $pdf->Cell(40, 10, 'Telephone: ' . $data['telephone']);
        $pdf->Ln(10); // Saut de ligne
        $pdf->Cell(40, 10, 'Montant restant de la dette: ' . $data['montant_restant']);
        $pdf->Ln(10); // Saut de ligne
        $pdf->Cell(40, 10, 'Montant: ' . $data['montant']. ' FCFA');
        $pdf->Ln(10); // Saut de ligne
        $pdf->Cell(40, 10, 'Date: ' . date('Y-m-d H:i:s'));

        // Nom du fichier
        $filename = 'recu_' .date('Y-m-d_H:i:s').$data['nom'].$data['prenom']. '.pdf';

        // Chemin complet du fichier
        $filePath = rtrim($outputDir, '/') . '/' . $filename;

        // Sauvegarder le fichier PDF dans le dossier spécifié
        $pdf->Output('F', $filePath);

        return $filePath;
    }
}