<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfModel extends CI_Model{

    public function content_bdc($societe, $fournisseur, $delai, $data){
        require_once(APPPATH . 'libraries/fpdf/fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',24);
        $pdf->Cell(0, 20, 'BON DE COMMANDE', 0, 5, 'C');

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(30,8,'Societe : ');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(60,8, $societe);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40,8,'Fournisseur :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(60,8, $fournisseur);
        
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(20,8,'Date : ');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(70,8, $societe);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50,8,'Delai de livraison :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(40,8, $fournisseur);

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(30,8,'Numero : ');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(60,8, $societe);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50,8,'Livraison partielle :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(40,8, $fournisseur);

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(90,8,'');
        $pdf->Cell(50,8,'Mode de paiement :');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(40,8, $fournisseur);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Ln();
        $pdf->Cell(40,20,'Bon de commande n:',);
        $pdf->Ln();
        $pdf->Cell(35,15,'Categorie',1, 0, 'C');
        $pdf->Cell(35,15,'Designation',1, 0, 'C');
        $pdf->Cell(20,15,'Qte',1, 0 , 'C');
        $pdf->Cell(35,15,'Prix unitaire',1, 0, 'C');
        $pdf->Cell(20,15,'TVA',1, 0, 'C');
        $pdf->Cell(45,15,'TTC',1, 0 , 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','',14);
        foreach($data as $row) {
            $pdf->Cell(35,15,'Categorie',1, 0, 'C');
            $pdf->Cell(35,15,'Designation',1, 0, 'C');
            $pdf->Cell(20,15,'Qte',1, 0 , 'C');
            $pdf->Cell(35,15,'Prix unitaire',1, 0, 'C');
            $pdf->Cell(20,15,'TVA',1, 0, 'C');
            $pdf->Cell(45,15,'TTC',1, 0 , 'C');
            $pdf->Ln();
        }
        $pdf->Cell(35,15,'');
        $pdf->Cell(35,15,'');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(20,15,'Total',1, 0 , 'C');
        $pdf->Cell(35,15,'Prix unitaire',1, 0, 'C');
        $pdf->Cell(20,15,'TVA',1, 0, 'C');
        $pdf->Cell(45,15,'TTC',1, 0 , 'C');
        
        $pdf->Ln();
        $pdf->Cell(130,20,'Arrete le present de bon de commande a la somme de ');

        $pdf->Ln();
        $text = "Votre texte ici. Il sera coupé si il dépasse la largeur de la cellule et continuera sur la ligne suivante.";
        $pdf->MultiCell(190, 10, $text);

        $pdf->Output('bdc.pdf', 'I');
    }

    public function demande_proforma($societe, $fournisseur, $delai, $data){
        require_once(APPPATH . 'libraries/fpdf/fpdf.php');

        $pdf = new FPDF();
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);
        $pdf->Output('proforma.pdf', 'I');
    }

    public function content_performa($pdf, $societe, $fournisseur, $delai, $data){
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',24);
        $pdf->Cell(0, 20, 'DEMANDE DE PROFORMA', 0, 5, 'C');

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(30,20,'Societe : ');
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(60,20, $societe);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40,20,'Fournisseur :');
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(60,20, $fournisseur);

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(55, 0,'Delai de livraison : ');
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(50, 0,$delai);

        $pdf->Ln();
        $pdf->Cell(10,20,'',);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(35,15,'',0, 0, 'C');
        $pdf->Cell(60,15,'Designation',1, 0, 'C');
        $pdf->Cell(60,15,'Quantite',1, 0 , 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','',16);
        foreach($data as $row) {
            $pdf->Cell(35,15,'',0, 0, 'C');
            $pdf->Cell(60, 15, $row[0], 1, 0, 'C');
            $pdf->Cell(60, 15, $row[1], 1, 0, 'C');
            $pdf->Ln();
        }
    }

    public function liste_proforma($societe, $fournisseur, $delai, $data){
        require_once(APPPATH . 'libraries/fpdf/fpdf.php');

        $pdf = new FPDF();
        
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);
        $this->content_performa($pdf, $societe, $fournisseur, $delai, $data);

        $pdf->Output('proforma.pdf', 'I');
    }
}